$(".evaluation").on('click', function() {
    const data = ($(this)[0])
    const id = parseInt(data.id);
    const btnUp= document.getElementById(id + 'plus')
    const btnDown = document.getElementById(id + 'minus')
    let evaluation  = document.getElementById('evaluation' + id)
    $.ajax({
        type: "POST",
        url: "evaluation",
        data:{
            value: data.value,
            id: id,
        },
        success: function(response) {
            evaluation.textContent = response.data.evaluation
            if (response.data.value !== 0){
                btnUp.disabled = (data.id === btnUp.id)
                btnDown.disabled = (data.id === btnDown.id)
            }else {
                btnUp.disabled = false
                btnDown.disabled = false
            }
        },
        error: function(response) {
            console.log(response.status);
        }
    })
});
