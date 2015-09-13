jQuery.noConflict();
(function($){
    $(function() {
        $('.wp-share-simple').sharrre({
  share: {
    twitter: true,
    facebook: true,
    googlePlus: true
  },
  template:  '<div class="wp-share-simple-box">'
	          	+'<div class="wp-share-simple-buttons">'
	          		+'<div class="wp-share-simple-facebook facebook">Share on facebook</div>'
	          		+'<div class="wp-share-simple-twitter twitter">Tweet on twitter</div>'
	          	+'</div>'
	            +'<div class="wp-share-simple-count">{total}<span>SHARES</span></div>'
	          +'</div>'
	       ,
  enableHover: false,
  enableTracking: true,
  render: function(api, options){
  $(api.element).on('click', '.twitter', function() {
    api.openPopup('twitter');
  });
  $(api.element).on('click', '.facebook', function() {
    api.openPopup('facebook');
  });
  $(api.element).on('click', '.googleplus', function() {
    api.openPopup('googlePlus');
  });
 }
 });
});

})(jQuery);