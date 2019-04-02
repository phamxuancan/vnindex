<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header">Home Component</div>

              <div class="card-body">
                <router-view></router-view>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Compsonent mounted.')
        }
    }
</script>