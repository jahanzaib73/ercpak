const getStates = () => {
    var session = $('#session').val();

    $.ajax({
        type: "POST",
        url: getTeamStatsUrl,
        data: {
            'session': session
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            if (response.status) {
                var cards = response.data.cardsData;
                $('#cardContainer').empty();
                $('#cardContainer').append(`
                <div class="col-12 col-lg-4">
                    <div class="card-body">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-6">
                                <h6 class="arabic">جميع &nbsp;</h6>
                                <h6> All </h6>
                            </div>
                            <div class="col-6 d-flex">
                                <div class="col-6 align-items-center">
                                    <div>
                                        <i class="fa-solid fa-street-view fa-lg text-danger"
                                            title="Number of Allottees"></i>
                                    </div>
                                    <div>
                                        <h3 id="totalAllottee">${response.data.allMembersCount}</h3>
                                    </div>
                                </div>
                                <div class="col-6 align-items-center">
                                    <div>
                                        <i class="fa-solid fa-earth-americas fa-lg text-danger" title="Number of Areas"></i>
                                    </div>
                                    <div>
                                        <h3 id="totalAreas">${response.data.allAreasCount}</h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button  data-id="0"
                            class="btn btn-outline-danger w-100 d-flex justify-content-between align-items-center team_filter">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </button>
                    </div>
                </div>
                `);

                $.each(cards, function (indexInArray, card) {
                    $('#cardContainer').append(`
                        <div class="col-12 col-lg-4">
                            <div class="card-body">
                                <div class="row d-flex align-items-center justify-content-between">
                                    <div class="col-6">
                                        <h6 class="arabic"> ${card.team_name_urdu} &nbsp;</h6>
                                        <h6> ${card.team_name} </h6>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <div class="col-6 align-items-center">
                                            <div>
                                                <i class="fa-solid fa-street-view fa-lg text-danger"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Number of Allottees"></i>
                                            </div>
                                            <div>
                                                <h3>${card.totalMembers}</h3>
                                            </div>
                                        </div>
                                        <div class="col-6 align-items-center">
                                            <div>
                                                <i class="fa-solid fa-earth-americas fa-lg text-danger"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Number of Areas"></i>
                                            </div>
                                            <div>
                                                <h3>${card.totalAreas}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button data-id="${card.team_id}" style="background-color: ${card.team_color} !important"
                                    class="btn btn-info w-100 d-flex justify-content-between align-items-center team_filter">
                                    <p>View</p><i class="fa-solid fa-eye"></i>
                                    <p class="arabic">منظر</p>
                                </button>
                            </div>
                        </div>`);
                });
            }
        },
        error: function (error) {

        }
    });
}

$('#session').change(function (param) {
    getStates();
    table.draw();
})

getStates();
