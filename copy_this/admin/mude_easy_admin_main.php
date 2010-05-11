<?php

class mude_easy_admin_main extends Shop_Config
{
    //own template
  protected $_sThisTemplate = 'mude_easy_admin_main.tpl';

  protected $_aConfigElements;

  protected $_sXmlFileName = "config.xml";

  public function init()
  {
    parent::init();
    $this->_aViewData['mude_config_menu'] = $this->_buildMenuTree();
  }

  public function render()
  {
    parent::render();

    return "mude_easy_admin_main.tpl";
  }

  protected function _buildMenuTree()
  {
    $aMenuStructure = $oXml = $this->_loadXml();
       
    return $aMenuStructure;
  }

  protected function _loadXml()
  {
    $aFiles = $this->_getConfigFiles();

    $sFile = array_pop($aFiles); //TODO merge files
    $sFileContent = file_get_contents($sFile);

    $oXml = new SimpleXMLElement( $sFileContent);

    $aMenuStructure = array();
    
    foreach ( $oXml->MODULE as $oModule) {
      $aMenuStructure[(string)$oModule['id']] = array();
      foreach ($oModule->GROUP as $oGroup) {
        $aMenuStructure[(string)$oModule['id']][(string)$oGroup['id']] = array();
        foreach ( $oGroup->SETTING as $oSetting) {
          $oElement = new stdClass();
          $oElement->type = (string)$oSetting['type'];
          $aMenuStructure[(string)$oModule['id']][(string)$oGroup['id']][(string)$oSetting['id']] = $oElement;
          foreach ( $oSetting->OPTION as $oOption) {
            $aMenuStructure[(string)$oModule['id']][(string)$oGroup['id']][(string)$oSetting['id']]->options[(string)$oOption['id']] = $oOption;
          }
        }
      }
    }
    return $aMenuStructure;
  }

  protected function _getConfigFiles()
  {
        $sSourceDir = getShopBasePath() . 'modules';
        
        $handle = opendir( $sSourceDir );
        while ( false !== ( $sFile = readdir( $handle ) ) ) {
            if ( $sFile != '.' && $sFile != '..') {
                $sDir = "$sSourceDir/$sFile";
                if ( is_dir( $sDir ) && file_exists( "$sDir/$this->_sXmlFileName" ) ) {
                        $aFilesToLoad[] = "$sDir/$this->_sXmlFileName";
                }
            }
        }
        return $aFilesToLoad;

  }


}