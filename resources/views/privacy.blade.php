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
    <p>PRIVACY</p>
    <p>Click the button to see smooth scroll to top.</p>
    Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate
    strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world
    view of disruptive innovation via workplace diversity and empowerment.<br><br>

    Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward,
    a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User
    generated content in real-time will have multiple touchpoints for offshoring.<br><br>

    Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital
    divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close
    the loop on focusing solely on the bottom line.<br><br>

    Podcasting operational change management inside of workflows to establish a framework. Taking seamless key
    performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive
    on the start-up mentality to derive convergence on cross-platform integration.<br><br>

    Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after
    installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.<br><br>

    Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for
    real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.<br><br>
    Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate
    strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world
    view of disruptive innovation via workplace diversity and empowerment.<br><br>

    Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward,
    a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User
    generated content in real-time will have multiple touchpoints for offshoring.<br><br>

    Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital
    divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close
    the loop on focusing solely on the bottom line.<br><br>

    Podcasting operational change management inside of workflows to establish a framework. Taking seamless key
    performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive
    on the start-up mentality to derive convergence on cross-platform integration.<br><br>

    Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after
    installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.<br><br>

    Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for
    real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.
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
