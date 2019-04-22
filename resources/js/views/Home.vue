<template>
<div>
  <section style="overflow: auto;height:90vh" v-if="data && foreignData == null" >
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th><abbr title="Position"></abbr></th>

      <th v-for="(day, index) in date" :key="index" v-bind:class="{ 'has-background-tb': index%2==0 }" class="has-text-centered" colspan="4">{{ day }}</th>
      
      
    </tr>
    <tr>
        <th class="has-text-centered has-background-grey-light">MÃ</th>
        <template v-for="(day, index) in date">
            <th :key="'date0'+index" class="has-text-centered has-background-grey-light">Giá</th>
            <th :key="'date1'+index" class="has-text-centered has-background-grey-light">KL</th>
            <th  :key="'date2'+index" class="has-text-centered has-background-grey-light">NNMua</th>
            <th :key="'date3'+index" class="has-text-centered has-background-grey-light">NNBan</th>
        </template>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item, index) in data" :key="index">
      <th class="has-text-centered">{{ index }}</th>
        <template v-for="(res, index) in item">
            <td :key="'data0'+index" v-bind:class="{'bg-tang': res.thamchieu>res.tchomqua,'bg-giam': res.thamchieu<res.tchomqua,'bg-bang': res.thamchieu== res.tchomqua, 'has-background-tb': index%2==0}"  class="has-text-centered">{{ res.thamchieu }}</td>
            <td :key="'data1'+index" v-bind:class="{ 'has-background-tb': index%2==0 }" class="has-text-centered">{{ res.khoiluong }}</td>
            <td :key="'data2'+index" v-bind:class="{ 'has-background-tb': index%2==0 }" class="has-text-centered">{{ res.nnmua }}</td>
            <td :key="'data3'+index" v-bind:class="{ 'has-background-tb': index%2==0 }" class="has-text-centered">{{ res.nnban }}</td>
        </template>
    </tr>
  </tbody>
</table>
</section>

  <section style="overflow: auto;height:90vh" v-if="data == null && foreignData" >
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
        <th class="has-text-centered has-background-grey-light">MÃ</th>
        <th class="has-text-centered has-background-grey-light">KL</th>
        <th class="has-text-centered has-background-grey-light">Tổng Mua</th>
        <th class="has-text-centered has-background-grey-light">Tổng Bán</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item, index) in foreignData" :key="index">
        <td :key="'data0'+index" class="has-text-centered">{{ item.code }}</td>
        <td :key="'data1'+index" class="has-text-centered">{{ item.nfsdf }}</td>
        <td :key="'data2'+index" class="has-text-centered">{{ item.tong_mua }}</td>
        <td :key="'data3'+index" class="has-text-centered">{{ item.tong_ban }}</td>
    </tr>
  </tbody>
</table>
</section>
</div>
</template>

<script>
import mapGetters from 'vuex';
    export default {
        layout:"index",
        mounted() {
            console.log(this.$route);
        },
        props: ['date','data','foreignData'],
        data(){
            return {
            }
        },
        created(){
            
        },
        methods:{
            logout(){
               this.axios.post('/api/logout')
            .then((response) => {
                this.$router.push('login');
            })
            .catch((error)=>{
            })
            }
        },
        computed:{
            //   ...mapGetters({
            //         is_login: 'checkLogin'
            //   })
        }
    }
</script>
<style scope="scss">
    .has-background-tb{
        background-color:#CCFFFF;
    }
    .bg-tang{
        background-color: #0f0!important;
    }
    .bg-giam{
        background-color: red!important;
    }
    .bg-bang{
        background-color: yellow!important;
    }
</style>
