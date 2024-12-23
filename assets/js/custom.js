jQuery(document).ready(function($) {

    //owlInit();

    handleScroll();

    $(window).on("scroll", handleScroll);

    toggleHeader();

    scrollTop();



    $(".main-menu ul li:first-child").addClass("active");



    $(window).scroll(function() {

        if ($(window).scrollTop() > 60) {

            $('header').addClass('scrolled');

        } else {

            $('header').removeClass('scrolled');

        }

    });







    $('.open-gallery').on('click', function() {



        var galleryId = $(this).data('gallery');

        var gallerySelector = "a[data-fancybox='" + galleryId + "']";

        var galleryContent = $(this).data('content');

        var galleryIcon = $(this).data('icon');



        $.fancybox.open($(gallerySelector), {

            loop: true,

            caption: function(instance, item) {

                // Here you can add the icon and textbox

                return `

                    <div class="container-fluid p-0">

                        <div class="icon-overlay">

                            <img src="${galleryIcon}" alt="icon">

                        </div>

                        <div class="custom-overlay">

                            <i class="custom-icon fa fa-info-circle"></i> <!-- Example icon -->

                            <div class="custom-text">

                                ${galleryContent}

                            </div>

                        </div>

                    </div>`;

            },

        });



    });



    $(".mobile-contact-us .btn").on("click", function() {

        $(".navbar-toggler").click();

    });

});





function scrollTop() {

    const scrollUpButton = jQuery('.scroll-up');



    jQuery(window).scroll(function() {

        if (jQuery(this).scrollTop() > 100) {

            scrollUpButton.fadeIn();

        } else {

            scrollUpButton.fadeOut();

        }

    });



    scrollUpButton.click(function() {

        jQuery('html, body').animate({scrollTop: 0}, 800);

    });

}





function toggleHeader() {

    jQuery(".navbar-toggler").click(function() {

        console.log('clicked');

        jQuery(".navbar-collapse").toggleClass("show");

    });



}



function owlInit() {

    jQuery('.owl-carousel').owlCarousel({

        loop: true,

        autoplay: true,

        autoplayTimeout: 3000,

        items: 1,

        dots: false,

        rtl: true,

        nav: false

    });

}



function isInViewport(element) {

    var rect = element.getBoundingClientRect();

    return (

        rect.top >= 0 &&

        rect.left >= 0 &&

        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&

        rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    );

}



function handleScroll() {

    jQuery(".reveal").each(function() {

        if (isInViewport(this) && !jQuery(this).hasClass("revealed")) {

            jQuery(this).addClass("revealed");

        }

    });

}



jQuery(document).ready(function($) {

    $('.navbar-toggler').click(function() {

        $(this).toggleClass('collapsed');

    });



    if ($(window).width() < 992) {

        $('.navbar-nav>li>a, .mobile-contact-us').on('click', function() {

            $('.navbar-nav>li').removeClass('active');

            $(this).addClass('active');

            $('.navbar-collapse').collapse('hide');

        });

    }

});



/*Business cards*/

jQuery(document).ready(function($) {
    $('.read-more').on('click', function() {
        const container = $(this).closest('.text-container');
        const truncatedText = container.find('.truncated-text');
        const fullText = container.find('.full-text');

        if (fullText.is(':hidden')) {
            fullText.show();
            truncatedText.hide();
        } else {
            fullText.hide();
            truncatedText.show();
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const bc = document.querySelector('.business-card')
    const bg = document.querySelector('.business_card__bg.business_card__ws')
    const wr = document.querySelector('span.business-card__wr')
    const br = document.querySelector('span.business-card__btm')

    if (bg && wr && br && bc) {
        const styles = window.getComputedStyle(bg)
        const top = styles.top

        if (bc.classList.contains('logo')) {
            wr.style.height = `calc(100% - ${top} - 180px)`
            br.style.height = `calc(100% - ${top} - 180px)`
        } else {
            if (window.innerWidth > 460) {
                wr.style.height = `calc(100% - ${top} - 280px)`
                br.style.height = `calc(100% - ${top} - 280px)`
            } else {
                wr.style.height = `calc(100% - ${top} - 180px)`
                br.style.height = `calc(100% - ${top} - 180px)`
            }
        }
    }

    lightGallery(document.getElementById('lightgallery1'));
    lightGallery(document.getElementById('lightgallery2'));

    const captureBtn = document.getElementById('capture-btn')

    if (captureBtn) {
        captureBtn.addEventListener('click', function() {
            const captureElement = document.getElementById('screenshot-area');
            const loader = document.querySelector('#capture-btn')


            if (captureElement && loader) {
                document.body.classList.add('screenshot')

                function filter(node) {
                    return !(node.className && node.classList.contains('business-card__bottom'));
                }

                downloadHtmlElementAsPng(captureElement, loader, filter)
            }
        });
    }

    async function downloadHtmlElementAsPng(node, loaderEl, filter) {
        const dataEncode = node.getAttribute('data-encode');

        if (dataEncode) {
            loaderEl.classList.add('loading')
            var link = document.createElement('a');
            link.href = dataEncode;
            link.download = 'screenshot.png';
            loaderEl.classList.remove('loading')
            link.click();
            document.body.classList.remove('screenshot')
        } else {
            const classList = document.body.className;
            const postIdMatch = classList.match(/postid-(\d+)/);
            const postId = postIdMatch ? postIdMatch[ 1 ] : null;

            loaderEl.classList.add('loading')
            await htmlToImage.toPng(node)
            await htmlToImage.toPng(node)
            await htmlToImage.toPng(node)

            const result = await htmlToImage.toPng(node, {filter: filter, cacheBust: true})
            if (postId && result) {
                uploadData(result, postId)
            }
            loaderEl.classList.remove('loading')
            var link = document.createElement('a');
            link.href = result;
            link.download = 'screenshot.png';
            link.click();
            document.body.classList.remove('screenshot')
        }
    }

    async function uploadData(dataEncode, postId) {
        jQuery.ajax({
            type: "POST",
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: "save_card_image",
                image: dataEncode,
                post_id: postId
            },
            success: function(data) {
                console.log(data);
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }

        });
    }

    const shareBtn = document.querySelector('.business-card__bottom .share_card')
    let shareTimeout = null;

    if (shareBtn) {
        const shareBtnUrl = shareBtn.getAttribute('data-url')
        let isCopied = false

        if (shareTimeout) {
            clearTimeout(shareTimeout)
        }

        if (shareBtnUrl) {
            shareBtn.onclick = (e) => {
                e.preventDefault()

                if (!isCopied) {
                    isCopied = true
                    function fallbackCopyTextToClipboard(text) {
                        const textArea = document.createElement("textarea");
                        textArea.value = text;
                        textArea.style.position = "fixed";
                        textArea.style.left = "-999999px";
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        try {
                            document.execCommand('copy');
                            console.log('Text copied to clipboard');
                            shareBtn.classList.add('copied');
                        } catch (err) {
                            console.error('Error copying text: ', err);
                        }
                        document.body.removeChild(textArea);
                    }

                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(shareBtnUrl).then(() => {
                            shareBtn.classList.add('copied');
                        }).catch(err => {
                            console.error('Error copying text: ', err);
                        });
                    } else {
                        fallbackCopyTextToClipboard(shareBtnUrl);
                    }


                    shareTimeout = setTimeout(() => {
                        isCopied = false
                        shareBtn.classList.remove('copied')
                    }, 3000)
                }
            }
        }
    }
})
AOS.init({
    once: true
});

/*END Business cards*/