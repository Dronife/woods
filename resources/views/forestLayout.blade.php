        <input name="surname" onkeypress='return /[a-ząčęėįšųūž ]/i.test(event.key)'
        id="name"
                                    type="text" required oninvalid="setCustomValidity('Only letters')" oninput="setCustomValidity('')"
                                     class="form-control input_user" value="{{Auth::user()->name}}" placeholder="Surname"><br>

                                    <input id="lastname"  name="lastname" onkeypress='return /[a-ząčęėįšųūž ]/i.test(event.key)'
                                    type="text" required oninvalid="setCustomValidity('Only letters')" oninput="setCustomValidity('')"
                                     class="form-control input_user" value="" placeholder="Lastname"><br>

                                    <input id="phone" name="phone" pattern="\+3706([0-9]{7})" 
                                    type="text" required oninvalid="setCustomValidity('Wrong format')" oninput="setCustomValidity('')"
                                     class="form-control input_user" value="" placeholder="Phone (+37064721963)"><br>

                                    <input id="email" pattern=".+@+.+" size="30" required oninvalid="setCustomValidity('Wrong format')"
                                    oninput="setCustomValidity('')" name="email" type="email" class="form-control input_user"
                                    value="{{Auth::user()->email}}" placeholder="E-Mail"><br>

                                    <input id="area" name="area" type="number" min="1" max="1000" required oninvalid="setCustomValidity('Wrong format')"
                                    oninput="setCustomValidity('')" class="form-control input_user" value="" placeholder="Area of Woods"><br>

                                    <div class="form-group">
                                        <select class="form-control" oninvalid="this.setCustomValidity('Must select')" 
                                        oninput="setCustomValidity('')" required name="type" id="type" style="width:100%">
                                            <option value="" selected="selected">..Type..</option>
                                            @foreach($config[0] as $key => $type)
                                                <option value="{{$type -> id}}">{{$type -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" oninvalid="this.setCustomValidity('Must select')" oninput="setCustomValidity('')"
                                        required name="age" id="age" style="width:100%">
                                            <option value="" selected="selected">..Age..</option>
                                            @foreach($config[1] as $key => $age)
                                                <option value="{{$age -> id}}">{{$age -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div> 


                                    <input id="price" name="price" type="number" min="1" max="10000000" required oninvalid="setCustomValidity('Only numbers')" 
                                     class="form-control input_user" value="" placeholder="Price">
                                    <br>