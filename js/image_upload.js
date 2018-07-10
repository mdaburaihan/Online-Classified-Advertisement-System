var pmfFileupload = {
   /* 
      Pretty mother fuckin File Upload input
   */
   init: function() {
      this.cacheDom();
      this.events();
   },
   cacheDom: function() {
      this.$filePlaceholder = $('.file-placeholder');
      this.$filelabel = this.$filePlaceholder.find('label');
      this.$fileUpload = this.$filePlaceholder.find('.fileUpload');
      this.$fileBrowseTxt = this.$filePlaceholder.find('.file-browse-txt');
   },
   events: function() {
      this.$fileUpload.on('change', this.getFileName.bind(this));
   },
   getFileName: function() {
      this.newVal = this.$fileUpload.val();
      if (this.newVal !== "") {
         this.$fileBrowseTxt.text(this.newVal).addClass('hasValue');
      } else {
         this.$fileBrowseTxt.text("Select a file...");
      }
   }
};

$(document).ready(function() {
   pmfFileupload.init();
});