<template>
    <router-view></router-view>
</template>
<script>
export default {
  name: "default",
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
    alert(1);
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
