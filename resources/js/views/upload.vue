<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>Files
        <input type="file" id="files" ref="files" multiple v-on:change="handleFileUploads()"/>
      </label>
      <button v-on:click="submitFiles()">Submit</button>
    </div>
  </div>
</template>
<script>
export default {
  name: "upload",
  mounted() {
    console.log("Compsonent mounted.");
  },
  data() {
    return {
      files: ""
    };
  },
  created() {},
  methods: {
    handleFileUploads() {
      this.files = this.$refs.files.files;
    },
    submitFiles() {
      let formData = new FormData();
      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append("files[" + i + "]", file);
      }
      axios
        .post("/api/multiple-files", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(function() {
          console.log("SUCCESS!!");
        })
        .catch(function() {
          console.log("FAILURE!!");
        });
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
