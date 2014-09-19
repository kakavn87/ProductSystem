<ul id="navTop">
  <img src="<?=base_url();?>css/images/logo_small.jpg" alt="Revierkönig" />
  <li <?if ($navstate == 'customer') { echo 'class="active"'; }?>><a href="<?=base_url();?>customer/show">Unternehmen</a></li>
  <li <?if ($navstate == 'attendant') { echo 'class="active"'; }?>><a href="<?=base_url();?>attendant/show">Personen</a></li>
  <li <?if ($navstate == 'product') { echo 'class="active"'; }?>><a href="<?=base_url();?>product/show">Projekte</a></li>
  <li <?if ($navstate == 'branch') { echo 'class="active"'; }?>><a href="<?=base_url();?>branch/show">Branchen</a></li>
  <li <?if ($navstate == 'group') { echo 'class="active"'; }?>><a href="<?=base_url();?>group/show">Etiketten</a></li>
  <li <?if ($navstate == 'search') { echo 'class="active"'; }?>><a href="<?=base_url();?>search/show">Analyse</a></li>
  <li class="<?if ($navstate == 'reminder') { echo 'active'; }?> allReminder"><a href="<?=base_url();?>reminder/show">Alle Wiedervorlagen</a></li>
  <div class="clear"></div>
</ul>

