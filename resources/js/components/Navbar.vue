<template>
    <div>
        <b-navbar toggleable="lg" class="color" fixed="top">
            <b-navbar-brand href="#"><img class="logo" src="img/fREEXER1.png" alt="Logo Kaskinha Sorvetes"></b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item href="/">Home</b-nav-item>
                    <b-nav-item href="/emitir-notas">Criar pedidos</b-nav-item>
                </b-navbar-nav>

                <b-navbar-nav class="ml-auto">
                    <b-nav-item v-if="user == undefined" href="/login">{{$lang.label.sing_in}}</b-nav-item>
                    <b-nav-item v-else @click="logout()">{{$lang.label.exit}}</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
  import { logout } from './../service/login.js';
  export default {
    name: 'navbar',

    props: {
      user: undefined
    },

    methods: {
      logout() {
        logout().then(response => {
          window.location = '/';
        })
      }
    },
  }
</script>

<style scoped>
    .logo {
        height: 55px;
    }

    .color {
        background-color: #9b1a1e;
        color: white;
    }

    .navbar-light .navbar-nav .nav-link {
        color: white;
    }
</style>