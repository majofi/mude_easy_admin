<?php

function smarty_function_mude_easy_admin_config_input( $params, &$smarty)
{

  $sTemplate = "mude_easy_admin_config_input.tpl";
  
  $sType = $params['type'];

  $sName = $params['name'];

  $sNameSpace = $params['namespace'];

  $sHelpConst = $sNameSpace . "HELP_" . $sName;

  $sDescriptionConst = $sNameSpace . "CONFIG_" . $sName;

  $smarty->assign( 'sHelpConst', $sHelpConst);
  $smarty->assign( 'sDescriptionConst' , $sDescriptionConst);
  $smarty->assign( 'sName', $sName);

  
  $readonly = $smarty->get_template_vars( 'readonly');

  switch ($sType) {
    case 'checkbox':
      $confbools = $smarty->get_template_vars( 'confbools');
      $sInput = "<input type=hidden name=confbools[$sName] value=false>";
      $sInput .= "<input type=checkbox name=confbools[$sName] value=true ";
      if ( $confbools[$sName] ) {
        $sInput .= " checked ";
      }
      $sInput .= $readonly .">";
      break;

    case 'text':
      $confstrs = $smarty->get_template_vars( 'confstrs');
      $sInput = "<input type=text class='txt' name=confstrs[$sName] value='$confstrs[$sName]'" . $readonly . ">";
      break;

    case 'array':
      $confarrs = $smarty->get_template_vars( 'confarrs');
      $sInput = "<textarea class='txtfield' name=confarrs[$sName] " . $readonly . ">$confarrs[$sName]</textarea>";
      break;

    case 'select':
      $confstrs = $smarty->get_template_vars( 'confstrs');
      $aOptions = $params['options'];
      $sInput = "<select name=confstrs[$sName]>";
      foreach ($aOptions as $sId => $sValue) {
        $sInput .= "<option value=$sValue ";

        if ( $sValue == $confstrs[$sName]) {
          $sInput .= "selected";
        }

        $sInput .= ">" . oxLang::getInstance()->translateString( $sId);
        $sInput .= "</option>";
      }
      $sInput .= "</select>";
      break;

    case 'multiple_select': //not supported yet
      $confarrs = $smarty->get_template_vars( 'confarrs');
      $aOptions = $params['options'];
      $sInput = "<select name=confarrs[$sName] multiple>";
      foreach ( $aOptions as $sId => $sValue) {
        $sInput .= "<option value=$sValue ";
          //TODO : mark selected
        $sInput .= ">" . oxLang::getInstance()->translateString( $sId);
        $sInput .= "</option>";
      }
      $sInput .= "</select>";
      break;

  default:
    break;
    
    }
  $smarty->assign( 'sInput', $sInput);

   return $smarty->fetch( $sTemplate);


}