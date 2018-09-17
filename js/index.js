$(document).ready(function(){
	if ($('div.s_photos').is('div')) $('div.s_photos').photos(); //инициализируем загрузчик фоток в нужном месте

	if ($('div.photos').is('div')) {
		var gallery = $('div.photos').attr('data-gallery');
		var loader = new LoadMorePhotos(0,4,gallery);
		$(window).on('scroll', function() {
			if($(window).scrollTop() + $(window).height() >= $(document).height()+50 && loader.stopScroll === false) {
				loader.stopScroll = true;
				loader.from += 4;
				loader.load(loader.from,loader.num,loader.gallery,loader);
		  }
    });
	}
});

function LoadMorePhotos(from,num,gallery) {
	this.from = from;
	this.num = num;
	this.gallery = gallery;
	this.stopLoad = false;
	this.stopScroll = false;
	this.load = function(from,num,gallery,obj) {
		console.log(this);
		if (this.stopLoad === true) return false;
		$.ajax({
      url: '/handler/loadMorePhotos',
      type: 'POST',
      data: {from:from,num:num,gallery:gallery},
      success: function(result) {
				if (result.html !== false) {
					$('div.photos').append(result.html);
					obj.stopScroll = false;
				} else {
					obj.stopLoad = true;
				}
      }
    });
	}
}
