<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="dark">
            <b-navbar-brand href="#">Nota Fácil</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item href="/">Home</b-nav-item>
                </b-navbar-nav>

                <b-navbar-nav class="ml-auto">
                    <b-nav-item-dropdown :text="$lang.label.lang" right>
                        <b-dropdown-item href="#" @click="$setLang('en')">EN</b-dropdown-item>
                        <b-dropdown-item href="#" @click="$setLang('pt-br')">PT-BR</b-dropdown-item>
                    </b-nav-item-dropdown>

                    <b-nav-item-dropdown right>
                        <template slot="button-content"><em>{{$lang.label.user}}</em></template>
                        <b-dropdown-item  href="/login">{{$lang.label.sing_in}}</b-dropdown-item>
                        <b-dropdown-item>{{$lang.label.profile}}</b-dropdown-item>
                        <b-dropdown-item>{{$lang.label.exit}}</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
  export default {
    name: 'navbar',
  }
</script>