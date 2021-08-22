<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
            <router-link class="navbar-brand mr-auto" to="/">Home</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'home'}">Home too</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home2'}">Second</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'test'}">Test</router-link>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>  <!-- Отображение вставленного компонента через роутер-->
        </div>

    </div>
</template>

