<link href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet">
<style>
    html {
        scroll-behavior: smooth;
    }

    #scrolltop {
        display: block;
        visibility: visible;
        opacity: 1;
        transition: visibility 0s, opacity 0.5s ease-in;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
    }

    .top-button {
        text-decoration: none;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.5;
        cursor: pointer;
        padding: 12px;
        color: #222;
    }

    body {
        background: linear-gradient(180deg, #0697f9 0%, #f898bf 100%);
        color: #fff;
        font-family: 'Quicksand', sans-serif;
        font-size: 24px;
        line-height: 1.4;
        text-align: center;
        padding: 40px;
    }

    .long-text {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px;
        background: rgba(0, 0, 0, 0.2);
    }

</style>
<body id="top">
<img src="{{asset('assets/logo.png')}}">

<h1>

</h1>

<div class="long-text">
    <p>Information Support</p>
    <p>Mobile : +972 59-254-5683.</p>
    <p>Email : Hakeemcare@gmail.com</p>
    <p>Telephone : 2899 36 52 5 </p>
    <p>Facebook : Hakeem.com.sa </p>
    <p>Instagram : Hakeem.instagram </p>
    <p>Address : Saudi Address </p>
    <p>.</p>

</div>
<div id="scrolltop">
    <a class="top-button" href="#top">&uarr;</a>
</div>

<script>
    const scrollTop = document.getElementById('scrolltop')
    window.onscroll = () => {
        if (window.scrollY > 0) {
            scrollTop.style.visibility = "visible";
            scrollTop.style.opacity = 1;
        } else {
            scrollTop.style.visibility = "hidden";
            scrollTop.style.opacity = 0;
        }
    };
    // get HTML templates at https://templateflip.com/
</script>
</body>
