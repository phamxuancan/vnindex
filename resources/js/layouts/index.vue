<template>
<div>
  <hr />
<b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="false"></b-loading>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Khối ngoại
        </a>

        <div class="navbar-dropdown">
          <a @click="foreign_buy()" class="navbar-item">
            Mua nhiều
          </a>
          <a @click="foreign_sell()" class="navbar-item">
            Bán nhiều
          </a>
        </div>
      </div>
      <div class="navbar-item has-dropdown is-hoverable">
        <a  @click="search_tbgd()" class="navbar-link">
          TB GD
        </a>
      </div>
      <div class="navbar-item has-dropdown is-hoverable">
        <a  @click="redirectBuyStrong()" class="navbar-link">
          Mua trội
        </a>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Lọc theo giá
        </a>

        <div class="navbar-dropdown">
          <a @click="search_price(1,10)" class="navbar-item">
            Từ 1->10
          </a>
          <a @click="search_price(10,20)" class="navbar-item">
             Từ 10->20
          </a>
          <a @click="search_price(20,30)" class="navbar-item">
            Từ 20->30
          </a>
          <a @click="search_price(30,40)" class="navbar-item">
             Từ 30->40
          </a>
          <a @click="search_price(40,50)" class="navbar-item">
             Từ 40->50
          </a>
          <a @click="search_price(50,500)" class="navbar-item">
             Từ 50 trở lên
          </a>
        </div>
      </div>
      <div class="field has-addons">
        <div class="control">
          <input class="input" type="text" v-model="code" placeholder="Mã ck">
        </div>
        <div class="control">
          <a @click="search()" class="button is-info">
            Search
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <router-link :to="{name:'login'}" v-if="!$store.state.is_login" @click="login();"  class="button is-light">
            Đăng nhập
          </router-link>
          <a v-if="$store.state.is_login" @click="logout();" class="button is-light">
            Đăng xuất
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- <div class="box cta">
    <div class="columns is-mobile is-centered">
        <div class="field is-grouped is-grouped-multiline">
            <div class="control"><span class="tag is-link is-large">Link</span></div>
            <div class="control"><span class="tag is-success is-large">Success</span></div>
            <div class="control"><span class="tag is-black is-large">Black</span></div>
            <div class="control"><span class="tag is-warning is-large">Wafrning</span></div>
            <div class="control"><span class="tag is-danger is-large">Danger</span></div>
            <div class="control"><span class="tag is-info is-large">Info</span></div>
        </div>
    </div>
</div> -->
<hr />
        <!-- View router !-->
        <router-view :date="date" :data="data" :foreignData="foreignData" ></router-view>
        <!-- end view router -->
<footer>
<div class="box cta">
    <div class="columns is-mobile is-centered">
        Development mode
    </div>
</div>
</footer>
</div>
</template>

<script>
export default {
  name: "index",
  mounted() {
    console.log("Compsonent mounted.");
  },
  data() {
    return {
      authenticated: false,
      code: null,
      date: null,
      data: null,
      isLoading: true,
      isFullPage: true,
      foreignData: null
    };
  },
  created() {
    // alert(1)
    this.axios.get("/api/display-vnindex").then(response => {
      this.date = response.data.data_date;
      this.data = response.data.array_by_date;
      this.isLoading = false;
    });
  },
  watch: {
    code: function(value) {
      if (this.code) {
        this.isLoading = true;
        this.axios
          .get("/api/display-vnindex?code=" + value)
          .then(response => {
            this.foreignData = null;
            this.date = response.data.data_date;
            this.data = response.data.array_by_date;
            this.isLoading = false;
          })
          .catch(error => {});
      }
    }
  },
  methods: {
    redirectBuyStrong() {
      this.$router.push({ name: "buy.strong" });
    },
    logout() {
      this.axios
        .post("/api/logout")
        .then(response => {
          this.$router.push("login");
        })
        .catch(error => {});
    },
    search() {
      if (this.code) {
        this.isLoading = true;
        this.axios
          .get("/api/display-vnindex?code=" + this.code)
          .then(response => {
            this.foreignData = null;
            this.date = response.data.data_date;
            this.data = response.data.array_by_date;
            this.isLoading = false;
          })
          .catch(error => {});
      }
    },
    search_price(from, to) {
      this.isLoading = true;
      this.axios
        .get("/api/display-vnindex?from=" + from + "&to=" + to)
        .then(response => {
          this.foreignData = null;
          this.date = response.data.data_date;
          this.data = response.data.array_by_date;
          this.isLoading = false;
        })
        .catch(error => {});
    },
    search_tbgd() {
      this.isLoading = true;
      this.axios
        .get("/api/stand-filter")
        .then(response => {
          this.foreignData = null;
          this.date = response.data.data_date;
          this.data = response.data.array_by_date;
          this.isLoading = false;
        })
        .catch(error => {});
    },
    foreign_buy() {
      this.isLoading = true;
      this.date = null;
      this.data = null;
      this.axios
        .get("/api/foreign?desc=1")
        .then(response => {
          this.foreignData = response.data;
          this.isLoading = false;
        })
        .catch(error => {});
    },
    foreign_sell() {
      this.isLoading = true;
      this.date = null;
      this.data = null;
      this.axios
        .get("/api/foreign?asc=1")
        .then(response => {
          this.foreignData = response.data;
          this.isLoading = false;
        })
        .catch(error => {});
    }
  }
};
</script>
<style>
.search-area {
  height: 100px;
}
.card {
  background-color: #209cee !important;
}
</style>
