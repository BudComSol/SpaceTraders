</div>
<footer class="dark-blur-bg footer-container box-shadow-large">
<a class="fs-6 m-0 rounded px-2 mb-1" href="https://github.com/ultimateXnova/ultimateXnova/" title="ultimateXnova" target="copy">ultimateXnova</a>{$VERSION}
| <a href="index.php?page=disclamer">{$LNG.menu_disclamer}</a>

</footer>
</div>
<div id="dialog" style="display:none;"></div>
<script>
var LoginConfig = {
    'isMultiUniverse': {$isMultiUniverse|json},
	'unisWildcast': {$unisWildcast|json},
	'referralEnable' : {$referralEnable|json},
	'basePath' : {$basepath|json}
};
</script>
{if $analyticsEnable}
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("{$analyticsUID}");
pageTracker._trackPageview();
} catch(err) {}</script>
{/if}
</body>
</html>
