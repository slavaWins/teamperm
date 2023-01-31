var Teamperm = EasyClass.New();

Teamperm.step = 0;


Teamperm.NewMemberListItem = function (e) {
    var self = {};
    self.e = e;

    self.prevRole = self.e.find("#id_memberType").val();
    self.e.find("#id_memberType").change(function () {

        var data = {
            team: e.attr("teamId"),
            uid: e.attr("uid"),
            role: $(this).val(),
        };

        EasyApi.Post("/team/member/set/" + data.team, data, function (response, error) {

            if (error) {
                self.e.find("#id_memberType").val(self.prevRole);
                return;
            }
            self.prevRole =    self.e.find("#id_memberType").val();
        }).ErrorToAlert(".errorShowMembers");

    });

    self.e.find(".deleteBtn").click(function () {
        var data = {
            team: e.attr("teamId"),
            uid: e.attr("uid"),
        };

        EasyApi.Post("/team/member/delete/" + data.team, data, function (response, error) {
            console.log(response);
            if (error) {
                return;
            }
            self.e.hide();
        }).ErrorToAlert(".errorShowMembers");


    });

    return self;
}

Teamperm.Init = function () {
    Teamperm.ElementsInit('.memberItemList', Teamperm.NewMemberListItem);
}


Teamperm.NextStep = function () {
    $('.alertPoll').hide();
    $('.btnNextStep').hide();


    var pollId = $('.pollId').attr('pollId');
    var data = Teamperm.GetFormDataCurrentStep();
    data.myStepNumber = Teamperm.step;


    var url = '/poll/validate/' + pollId;

    if (Teamperm.step == Teamperm.stepCount - 1) {
        console.log("LAST STEP");

        $('#formFinal').hide();
        $('#formFinal').append($('.stepPollContainer input'));
        $('#formFinal').append($('.stepPollContainer select'));
        $('#formFinal').append($('.stepPollContainer checkbox'));
        $('#formFinal').append($('.stepPollContainer radio'));
        $('#formFinal').submit();
        return;

    }

    EasyApi.Post(url, data, function (response, error) {
        if (error) {
            Teamperm.RenderStep();
            $('.alertPoll').show();
            $('.alertPoll').html(error);
            return;
        }
        Teamperm.step += 1;
        Teamperm.RenderStep();
    });
}


window.Teamperm = Teamperm;
