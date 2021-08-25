

//CCTV ID Update
function updateId(){
 
  


}

const toTopEl = document.querySelector('#isService') as HTMLParagraphElement
const isServiceItem = {
  buttonName: toTopEl.innerHTML,
  nameChange:function(){
    //toTopEl.innerHTML ="dddddd"
    console.log("Test")
    if(this.buttonName === '사용안함')
    {
      this.buttonName = "사&nbsp;&nbsp;용";
    }else{
      this.buttonName = "사용안함";   
    }  
  }
}

updateId()