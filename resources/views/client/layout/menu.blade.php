<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>

        @foreach($listBrandCategory as $key => $brandCategory)

            <li href="#" class="list-group-item menu1">
                {{$key}}
            </li>
            <ul>
                @foreach($brandCategory as $index => $category)
                    <li class="list-group-item">
                        <a href="#">
                            {{$category[0]}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>
</div>
