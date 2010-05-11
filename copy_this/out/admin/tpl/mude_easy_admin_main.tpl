[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
<!--
function _groupExp(el) {
    var _cur = el.parentNode;

    if (_cur.className == "exp") _cur.className = "";
      else _cur.className = "exp";
}
//-->
</script>

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]


<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="shop_config">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="actshop" value="[{ $shop->id }]">
    <input type="hidden" name="updatenav" value="">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="mude_easy_admin_main">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="editval[oxshops__oxid]" value="[{ $oxid }]">


[{foreach from=$mude_config_menu item=aModules key=sModule}]

  <h2>[{ oxmultilang ident=$sModule }]</h2>
    [{foreach from=$aModules item=aGroups key=sGroup}]
      <div class="groupExp">
          <div>
              <a href="#" onclick="_groupExp(this);return false;" class="rc"><b>[{ oxmultilang ident=$sGroup }]</b></a>
              [{foreach from=$aGroups item=oElement key=sSetting}]
                [{if $oElement->type == "boolean"}]
                  [{mude_easy_admin_config_input name=$sSetting type="checkbox"}]
                [{/if}]
                [{if $oElement->type == "string"}]
                  [{if $oElement->options}]
                    [{mude_easy_admin_config_input name=$sSetting type="select" options=$oElement->options}]
                  [{else}]
                    [{mude_easy_admin_config_input name=$sSetting type="text"}]
                  [{/if}]
                  
                [{/if}]
                [{if $oElement->type == "array"}]
                  [{if $oElement->options}]
                    [{*mude_easy_admin_config_input name=$sSetting type="multiple_select" options=$oElement->options*}] [{*NOT SUPPORTED YET*}]
                  [{else}]
                    [{mude_easy_admin_config_input name=$sSetting type="array"}]
                  [{/if}]
                [{/if}]

              [{/foreach}]
          </div>
      </div>
      [{/foreach}]
  [{/foreach}]

    <br>

    <input type="submit" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'" [{ $readonly}]>


</form>


[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]