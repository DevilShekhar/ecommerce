/*====================================================
        PREMIUM LOGIN PAGE
====================================================*/

document.addEventListener("DOMContentLoaded", function () {

    /*======================================
        Password Show / Hide
    ======================================*/

    const password = document.getElementById("password");
    const toggle = document.getElementById("togglePassword");

    if (password && toggle) {

        toggle.addEventListener("click", function () {

            const type = password.getAttribute("type") === "password"
                ? "text"
                : "password";

            password.setAttribute("type", type);

            this.classList.toggle("zmdi-eye");
            this.classList.toggle("zmdi-eye-off");

        });

    }

    /*======================================
        Input Animation
    ======================================*/

    document.querySelectorAll(".input-box input").forEach(function (input) {

        input.addEventListener("focus", function () {

            this.parentElement.classList.add("active");

        });

        input.addEventListener("blur", function () {

            if (this.value === "") {

                this.parentElement.classList.remove("active");

            }

        });

    });

    /*======================================
        Login Button Loading
    ======================================*/

    const form = document.querySelector("form");
    const button = document.querySelector(".btn-login");

    if (form && button) {

        form.addEventListener("submit", function () {

            button.disabled = true;

            button.innerHTML = `
                <span class="spinner-border spinner-border-sm mr-2"></span>
                Signing In...
            `;

        });

    }

    /*======================================
        Fade Page
    ======================================*/

    document.body.style.opacity = "0";

    setTimeout(function () {

        document.body.style.transition = "opacity .6s";

        document.body.style.opacity = "1";

    }, 100);

    /*======================================
        Social Hover Effect
    ======================================*/

    document.querySelectorAll(".social-login button").forEach(function(btn){

        btn.addEventListener("mouseenter",function(){

            this.style.transform="translateY(-6px) scale(1.08)";

        });

        btn.addEventListener("mouseleave",function(){

            this.style.transform="translateY(0px)";

        });

    });

    /*======================================
        Ripple Effect
    ======================================*/

    document.querySelectorAll(".btn-login").forEach(function(btn){

        btn.addEventListener("click",function(e){

            let ripple=document.createElement("span");

            ripple.className="ripple";

            this.appendChild(ripple);

            let x=e.clientX-this.offsetLeft;

            let y=e.clientY-this.offsetTop;

            ripple.style.left=x+"px";

            ripple.style.top=y+"px";

            setTimeout(()=>{

                ripple.remove();

            },600);

        });

    });

});