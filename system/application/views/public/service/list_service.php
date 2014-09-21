<div class="searchbox">
	<span>Search: </span>  <input type="text" class="searchword" id="searchword" value="" />
</div>

<div class="addButtonTop">
							<a href="javascript:void(0);"><span class="greenFont">+</span>
								Add new service</a>
						</div>
<div id="scroller" class="scrollerNav">
          <ul id="navLeft">
          <?php 
          
          ?>
          
           <?php foreach ($services as $service) :?>
              <li><p><?= $service->name; ?></p>
								<span class="navArrow"></span>
								<div class="clear"></div></li>
           <?php endforeach; ?>
          </ul>

					</div>
