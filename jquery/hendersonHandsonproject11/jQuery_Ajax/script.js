function adjustImage(){
    let width=$(window).width()

    if(width<600){
        $("#img1, #img2").css("border-radius","20px")
    }
    else{
        $("#img1, #img2").css("border-radius","0px")
    }
}
adjustImage()
$(window).resize(function (){
    adjustImage()
})