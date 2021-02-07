<div class="row d-flex">
    <div class="mr-auto p-1">
        <div class="collapse multi-collapse show" id="collapsediv">
            <button id='filterButton' class='btn btn-info' data-toggle="collapse" href="#collapsediv" role="button" aria-expanded="false" aria-controls="collapsediv">Filter</button>
        </div>
        <div class="collapse multi-collapse " id="collapsediv">
            <button id='cancleFilter' class='btn btn-secondary' data-toggle="collapse" href="#collapsediv" role="button" aria-expanded="false" aria-controls="collapsediv">Cancle</button>
        </div>
    </div>


    <div class=" p-1">
        <div class="collapse multi-collapse float-right p-1" id="collapsSearch">
            <button id='exitSearch' class="btn  btn-secondary btn-sm" data-toggle="collapse" href="#collapsSearch" role="button" aria-expanded="false" aria-controls="collapsSearch">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>
        </div>
        <div class="collapse multi-collapse show float-right p-1" id="collapsSearch">

            <button id='searchButton' class='btn btn-info' data-toggle="collapse" href="#collapsSearch" role="button" aria-expanded="false" aria-controls="collapsSearch">Search</button>
        </div>

        <div class="collapse multi-collapse float-right p-1" id="collapsSearch">
            <input id="search" type="text" class="form-control">


        </div>


    </div>

</div>
<br>
<div id="filterDiv" class="col-md-5">
    <div class="collapse multi-collapse" id="collapsediv">
        <!-- <button style="float: right;" id='cancleButton' class='btn btn-secondary' data-toggle="collapse" href="#collapsediv" role="button" aria-expanded="false" aria-controls="collapsediv">Cancle</button> -->
        <div id="leftDiv" style=" text-align: left;">
            <div class="form-group">
                <input type="radio" id="Temperate" name="type" value="Temperate">
                <label for="nonx">Temperate </label>
                <input type="radio" id="Boreal" name="type" value="Boreal">
                <label for="xmas">Boreal</label>
                <input type="radio" id="Mixed" name="type" value="Mixed">
                <label for="mixed">Mixed</label>
                <input type="radio" id="All" name="type" value="All" checked>
                <label for="other">All</label>
            </div>
            <div class="form-group">
                <input type="radio" id="Young" name="age" value="Young">
                <label for="male">Young</label>
                <input type="radio" id="Wise" name="age" value="Wise">
                <label for="female">Wise</label>
                <input type="radio" id="All" name="age" value="All" checked>
                <label for="other">All</label>
            </div>
        </div>
    </div>
</div>