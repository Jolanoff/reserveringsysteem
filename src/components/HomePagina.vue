<template>
    <div class="header main-header">

        <div class="container text-center" style="min-width: 100%">
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <div class=" mt-5">
                        <h1>Welkom {{username}}</h1>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="col mt-5 d-flex justify-content-center cards">
                        <router-link class="single-card" to="/ReserveringAanmaken"><a href="">Reservering aanmaken</a>
                        </router-link>
                    </div>
                    <div class="col mt-2 d-flex justify-content-center cards">
                        <router-link class="single-card" to="/medewerkers"><a href="">Reservering overzicht</a>
                        </router-link>
                    </div>
                    <div class="col mt-2 d-flex justify-content-center cards">
                        <router-link class="single-card" to="/beschikbaarPlekken"><a href="">Overzicht van campingplaatsen</a>
                        </router-link>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    data: function () {
        return {
            username: sessionStorage.getItem('username')
        };
    },


    
    methods: {
        users: [],
        newUser: { username: "", wachtwoord: "" }
        
    },
    created(){
        if(!sessionStorage.getItem('role')){
            location.href ='/'
        }
    }
    
}

</script>

<style>
.single-card {
    border-radius: 10% / 50%;
    background: #2A9D8F;
box-shadow: inset -5px -5px 0px #195e56,
            inset 5px 5px 0px #3bdcc8;
    padding: 2%;
    min-width: 50%;
    text-align: center;
    
    transition: 0.5;

}

.cards a {
    text-decoration: none;
    display: flex;
    justify-content: center;
    font-size: 3vh;
    color: rgb(0, 0, 0);
    
    font-weight: 800;
    
}

.main-header {

    height: 92.3vh;
    background-image: url(../assets/imgs/vecteezysummer-camping-backgroundab0421_generated.jpg);
    background-repeat: no-repeat;
    background-size: 100% 100%;


}

h5,
h1 {
    font-weight: 900;
}

.welkom {
    background-color: #2A9D8F;
}

 @-webkit-keyframes shadow-pop-br {
  0% {
    -webkit-box-shadow: 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e;
            box-shadow: 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e;
    -webkit-transform: translateX(0) translateY(0);
            transform: translateX(0) translateY(0);
  }
  100% {
    -webkit-box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e, 4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e, 8px 8px #3e3e3e;
            box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e, 4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e, 8px 8px #3e3e3e;
    -webkit-transform: translateX(-8px) translateY(-8px);
            transform: translateX(-8px) translateY(-8px);
  }
}
@keyframes shadow-pop-br {
  0% {
    -webkit-box-shadow: 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e;
            box-shadow: 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e, 0 0 #3e3e3e;
    -webkit-transform: translateX(0) translateY(0);
            transform: translateX(0) translateY(0);
  }
  100% {
    -webkit-box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e, 4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e, 8px 8px #3e3e3e;
            box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e, 4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e, 8px 8px #3e3e3e;
    -webkit-transform: translateX(-8px) translateY(-8px);
            transform: translateX(-8px) translateY(-8px);
  }
}
.single-card:hover{
	-webkit-animation: shadow-pop-br 0.3s cubic-bezier(0.470, 0.000, 0.745, 0.715) both;
    -webkit-animation: shadow-pop-br 0.3s cubic-bezier(0.470, 0.000, 0.745, 0.715) both;

}

</style>