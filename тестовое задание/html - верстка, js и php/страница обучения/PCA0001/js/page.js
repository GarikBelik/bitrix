var Page = function () {
    var self = this;
    self.config = {
		set : 1, // active 'set' buttons ( if mode button = 'set' )
        mode : 1, // active type button
        layout: 6, // current layout
		cookie: 0,
        labeled: 'on',
        instruction: 'Cut out on dotted lines.',
		total_pages: 0,
        current_page: 0,
		first_load: true,
		category: 'mammals'
    };

	var pages = [],
        total_pages = null,
        wrap = $('.wrapper'),
		cm = $('.customize-menu'),
		tsm = $('.toggle-select-menu'),
        lt = $('.layout-menu'),
		lm = $('.labeled-menu'),
        os =$('.open-selector'),
        panel = $('.pages-panel'),
        slidesWrap = $('.slide-panel'),
        pagination = $('.pagination');
	
    self.init = function () {
        self.generateCustomizeMenu();
        self.activateControls();
		self.attachHandlers();
		self.preparePagesArray();
		self.generateStage();
	};

	self.generateCustomizeMenu = function () {
        Application.getXML(function (xml) {
            var $customize_menu = $('.customize-menu');
            $customize_menu.empty();
            $(xml).find('category:contains(' + self.config.category + ')').each(function (i, e) {
                var type = $(this).parent().find('type').text();
                $customize_menu.append('<a href="javascript:void(0);" class="btn" data-type="' + type + '">' + type.ucfirst() + '</a>');
            });
        });
    };
	
    self.activateControls = function (name,data) {
		if(self.config.first_load){
			$('[data-type]').removeClass('active').slice(0, self.config.layout).addClass('active');
			self.config.first_load = false;
		}
		switch(name){
			case 'layout':
					$('[data-layout="' + self.config.layout + '"]').removeClass('active');
					self.config.layout = data;
					$('[data-layout="' + data + '"]').addClass('active');
				break;
			case 'labeled':
					$('[data-labeled="' + self.config.labeled + '"]').removeClass('active');
					self.config.labeled = data;
					$('[data-labeled="' + data + '"]').addClass('active');
				break;
			case 'type':
					$('[data-type="'+ data +'"]').hasClass('active') ?
                        $('[data-type="'+ data +'"]').removeClass('active') :
                        $('[data-type="'+ data +'"]').addClass('active');
				break;
			case 'toggleSelect':
					(data === 'deselect') ? $('.customize-menu a').removeClass('active') : $('.customize-menu a').addClass('active');
				break;
			default:
					$('[data-category="' + self.config.category + '"],' +
                      '[data-layout="' + self.config.layout + '"],' +
                      '[data-labeled="' + self.config.labeled + '"]').addClass('active');

		}
	};
	
    self.attachHandlers = function () {
		$.each([[cm,null],[tsm,null],[lm,null],[lt,null],[wrap,'.previous-page'],[wrap,'.next-page'],
            [slidesWrap,'.page-thumbnail:not(.active)']],function(i, v) {
                v[0].on('click',(v[1]) ? v[1] :'a.btn', function() {
                    var data = Object.keys($(this).data())[0],
                        index = $(this).data(data);
					if('to' === data && 'next-page' == $.trim($(this).attr('class').split('declare')[0]) )
                        self.config.current_page += 1;
                    else if('to' === data && 'previous-page' == $.trim($(this).attr('class').split('declare')[0]) )
                        self.config.current_page -= 1;
                    else if('preview' === data) self.config.current_page = index;
					self.activateControls(data, index);
                    self.regeneratePages();
        } ) } );
		
		wrap.on('click','.pages, .open-selector', function() {
            var mode = 0;
            if(os.hasClass('active')) {
                os.removeClass('active'); mode = 1;
            } else os.addClass('active');
            panel.animate({top : (mode) ? -parseInt(panel.height() + 5) : mode }, function() {
                os.find('img').attr('src','/assets/ui/arrow-'+ ['up','down'][mode]  +'.svg');
            });
        });
		
		$('.controls').on('click', '.font-toggle', function () {
			self.config.cookie = (self.config.cookie == 0) ? 1 : 0;
			$.cookie('font', self.config.cookie, {expires: 365});
        });
        /**
         * Switches the category of animals
         */
        $('.category-menu').on('click', 'a:not(.active)', function () {
            var $this = $(this);
            Application.createPopup('Switching the category will delete your current worksheet. Would you like to continue?', function () {
                self.changeCategory($this);
                Application.removePopup();
            }, function () {
                Application.removePopup();
            });
        });
    };

    self.preparePagesArray = function() {
        var i, a  = -1, items = self.makeItemsArray(); pages = [];
        if(items.length)
            for(i = 0; i < items.length; i++)
                if(!Math.abs(i % self.config.layout)) {
                    a++;
                    pages[a] = [ items[i] ];
                }
                else pages[a].push( items[i] );
        self.removeBlankPages();
    };

    self.removeBlankPages = function() {
        for(var i = 0; i < pages.length; i++) {
            var cleaner = 0;
            for(var j = 0; j < self.config.layout; j++) {
                if(!pages[i][j]) cleaner++;
            }
            if(cleaner == self.config.layout)
                pages[i] = null;
        }
    };
	
    self.changeCategory = function (e) {
        $('.category-menu a').removeClass('active');
        e.addClass('active');
        self.config.category = e.data('category');
        self.generateCustomizeMenu();
        $('[data-type]').slice(0, self.config.layout).addClass('active');
        self.config.current_page = 1;
        self.regeneratePages();
    };

    self.regeneratePages = function () {
		self.preparePagesArray();
		self.generateStage();
    };

    self.generateStage = function () {
		var i = 0, z, print, stage, item, footer, pageNumber = self.config.total_pages;
        wrap.find('.print-block').remove();
		for( i; i < pages.length; i++ ) {
            if(pages[i]) {
                print = $('<div class="print-block">').attr('data-page',i+1);
                stage = $('<div>').addClass('stage-contain layout-' + self.config.layout);
                footer = $('<div>').addClass('stage-footer')
                    .append($('<div>').addClass('instructions').text(self.config.instruction),$('<div>').addClass('logo')
                        .append($('<img>').hide(0).addClass('stageLogo1').attr('src','/assets/ui/logo-black.svg')));
                if('object' === typeof pages[i]) {
                    for(z in pages[i]) if(pages[i].hasOwnProperty(z)) {
                        item = $('<div>').addClass('stage-item');
						if(pages[i].length){
								item.append('<div class="item-image"><img  src="' + self.config.img_path + pages[i][z] + '.svg" /></div>');
								if('on' == self.config.labeled)
									item.append('<span class="label' + ((self.config.cookie == 1) ? ' script' : '') + '">' + pages[i][z] + '</span>');
                        }else  item.append( null );
                        stage.append(item);
                    }
				}
                wrap.append( print.append(stage, footer) );
            }
        }
        Application.generateStageNavigation(pages, total_pages);
    };

	self.makeItemsArray = function(){
		var items = [],
			start = 0,
            end = $('.customize-menu a.active:last').index()+1,
            buttons = $('.customize-menu a.active').slice(start, end);
        buttons.each(function (i, e) { items.push(($(e).data('type'))) });
        return items;
	};

    self.toggleScript = function (cookie) {
        if (cookie == 0) {
            $('.wrapper .stage-contain').removeClass('script');
			$('.stage-item .label').removeClass('script');
        } else {
			$('.stage-item .label').addClass('script');
            $('.wrapper .stage-contain').addClass('script');
        }
    };
};
