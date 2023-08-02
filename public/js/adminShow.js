    $(document).ready(function () {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            arrows: false,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true
        });

    });
    class readMore {
        constructor() {
            this.content = '.readmore__content';
            this.buttonToggle = '.readmore__toggle';
        }

        bootstrap() {
            this.setNodes();
            this.init();
            this.addEventListeners();
        }

        setNodes() {
            this.nodes = {
                contentToggle: document.querySelector(this.content)
            };
            this.buttonToggle = this.nodes.contentToggle.parentElement.querySelector(this.buttonToggle);
        }
        init() {
            const { contentToggle } = this.nodes;
            this.stateContent = contentToggle.innerHTML;
            contentToggle.innerHTML = `${this.stateContent.substring(0, 300)}...`;
        }
        addEventListeners() {
            this.buttonToggle.addEventListener('click', this.onClick.bind(this))
        }
        onClick(event) {
            const targetEvent = event.currentTarget;
            const { contentToggle } = this.nodes
            if (targetEvent.getAttribute('aria-checked') === 'true') {
                targetEvent.setAttribute('aria-checked', 'false')
                contentToggle.innerHTML = this.stateContent;
                this.buttonToggle.innerHTML = ''
            } else {
                targetEvent.setAttribute('aria-checked', 'true')
                contentToggle.innerHTML = `${this.stateContent.substring(0, 300)}...`
                this.buttonToggle.innerHTML = 'Read More'
            }
        }
    }


    const initReadMore = new readMore();
    initReadMore.bootstrap()    
