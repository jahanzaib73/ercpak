<div class="overlay">
    <div class="overlay__inner">
        <div class="overlay__content"><span class="spinner"></span></div>
    </div>
</div>

<style type="text/css">
    .overlay {
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        background: #222;
        z-index: 999999999 !important;
        opacity: 0.7;
    }

    .overlay__inner {
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        position: absolute;
    }

    .overlay__content {
        left: 50%;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .spinner {
        width: 75px;
        height: 75px;
        display: inline-block;
        border-width: 10px;
        border-color: rgba(255, 255, 255, 0.1);
        border-top-color: #fff;
        animation: spin 1s infinite linear;
        border-radius: 100%;
        border-style: solid;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        console.info('OverLay Widget Initialize');
        $('.overlay, .overlay__inner, .overlay__content, .spinner').fadeOut("fast");
    });

    function showOverLay() {

        console.info('called showOverLay');
        $('.overlay, .overlay__inner, .overlay__content, .spinner').fadeIn("fast");
    }

    function hideOverLay() {

        console.info('called hideOverLay');
        $('.overlay, .overlay__inner, .overlay__content, .spinner').fadeOut().delay(1200);
    }
</script>
