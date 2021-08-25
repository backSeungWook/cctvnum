"use strict";
//CCTV ID Update
function updateId() {
}
var toTopEl = document.querySelector('#isService');
var isServiceItem = {
    buttonName: toTopEl.innerHTML,
    nameChange: function () {
        //toTopEl.innerHTML ="dddddd"
        console.log("Test");
        if (this.buttonName === '사용안함') {
            this.buttonName = "사&nbsp;&nbsp;용";
        }
        else {
            this.buttonName = "사용안함";
        }
    }
};
updateId();
