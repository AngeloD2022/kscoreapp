class GameCore {


    constructor(type, kenstonScoreIndicator, guestScoreIndicator, identifier){
        this.kenstonScoreIndicator = kenstonScoreIndicator;
        this.guestScoreIndicator = guestScoreIndicator;
        this.id = this.id;
    }

    isFirstLoad(){
        var xhr = new XMLHttpRequest();
        $.ajax({
            type: "GET",
            url: "/app/eventData.php?id="+this.id,
            success: function (response) {
                if(response["misc"] == null){
                    return true;
                }
                return false;
            }
        });
    }

    

}