<!-- search -->
<form class="search left" method="get" action="<?php echo home_url(); ?>" role="search" id="global-search">
	<label href="javascript:void(0)" class="search-control" for="s" onclick="jQuery('#global-search').toggleClass('expanded');"></label>
	<div class="form-item">
  		<!--<label for="s">Search</label> -->
		<input class="search-input" type="text" name="s" id="s" autocomplete="off" placeholder="Search">
		<button class="search-submit" type="submit" role="button"></button>
    </div><!-- end form item -->
</form>
<!-- /search -->