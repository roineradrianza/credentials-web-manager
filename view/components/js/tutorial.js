let viewer;
$("img").click(function () {
	image = $(this).attr("id");
	viewImage(image);
})
function viewImage(image){
	viewer = new Viewer(document.getElementById(image), {
	navbar: 0,
	title: [1,(image, imageData) => `${image.alt}`],
	toolbar: {
    zoomIn: 1,
    zoomOut: 1,
    oneToOne: 0,
    reset: 4,
    prev: 0,
    play: {
      show: 0,
    },
    next: 0,
    rotateLeft: 0,
    rotateRight: 0,
    flipHorizontal: 0,
    flipVertical: 0,
	  },
		maxZoomRatio: 200,
		ready(){
			interval: 10
		},
		/*
		viewed() {
	    this.viewer.zoom(0.2);
	  }
	  */
	});
}