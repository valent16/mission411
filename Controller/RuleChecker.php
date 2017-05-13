<?php
/**
 * Created by PhpStorm.
 * User: Antoine Croisille
 * Date: 08/05/2017
 * Time: 14:35
 */
//Script qui permet d'associer un score de réussite à une règle en fonction d'un cursus
class RuleChecker
{

    private static function isValidate($lettre)
    {
        $ok = ['A', 'B', 'C', 'D', 'E'];
        if (in_array($lettre, $ok)) {
            return true;
        } else {
            return false;
        }
    }

    private static function inUTT($elementsFormation, $c)
    {
        if ($c == null) {
            return true;
        } elseif ($elementsFormation->getElementFormation()->getUtt() == 1 && $c == 'UTT') {
            return true;
        } else return false;
    }

    private static function isAffected($elementsFormation, $affectation)
    {
        if ($affectation == 'UTT' && $elementsFormation->getElementFormation()->getUtt() == 1) {
            return true;
        } elseif ($elementsFormation->getAffectation() == $affectation) {
            return true;
        } elseif (strpos($elementsFormation->getAffectation(), $affectation) !== false) {
            return true;
        } else {
            return false;
        }
    }

    private static function sum($elementsFormationEffectue, $cadre, $categories, $affectation)
    {
        $total = 0;
        foreach ($elementsFormationEffectue as $efe) {
            if ($categories[0] == 'ALL') {
                if (RuleChecker::isValidate($efe->getResultat()) && RuleChecker::inUTT($efe, $cadre)) {
                    $total += $efe->getCredit();
                }
            } elseif (in_array($efe->getElementFormation()->getCategorie(), $categories) && RuleChecker::isAffected($efe, $affectation)
                && RuleChecker::inUTT($efe, $cadre) && RuleChecker::isValidate($efe->getResultat())
            ) {
                $total += $efe->getCredit();
            }
        }
        return $total;
    }

    private static function exist($elementsFormationEffectue, $categorie, $affectation)
    {
        $total = -1;
        foreach ($elementsFormationEffectue as $efe) {
            if ($efe->getElementFormation()->getSigle() == $categorie[0] && RuleChecker::isAffected($efe, $affectation)) {
                $total += 1;
            }
        }
        return $total;
    }

    public static function evaluateRules($regulation, $elementsFormationEffectue){
        foreach ($regulation->getRules() as $rule)
        {
            //Pour chacune des règles du règlement
            switch ($rule->getRule())
            {
                case 'SUM' :
                    $rule->setScoreEffectif(RuleChecker::sum($elementsFormationEffectue, $rule->getCadre(), $rule->getCategories(), $rule->getAffectation()));
                    //echo $rule->getScoreEffectif() . '<br \>';
                    break;
                case 'EXIST' :
                    $rule->setScoreEffectif(RuleChecker::exist($elementsFormationEffectue, $rule->getCategories(), $rule->getAffectation()));
                    //echo $rule->getScoreEffectif() . '<br \>';
                    break;
                default : echo 'Règle inconnue';
                    break;
            }
        }
        return $regulation;
    }

}
?>