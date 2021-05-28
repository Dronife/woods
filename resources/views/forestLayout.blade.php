                                    <div class="form-group">

                                        <input name="surname" id="surname"
                                        type="text" class="form-control  @error('surname') is-invalid @enderror" value="{{Auth::user()->name}}" placeholder="Surname">
                                        @error('surname')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="lastname"  name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="" required  placeholder="Lastname">

                                        @error('lastname')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                    </div>

                                    <div class="from-group">
                                        <input  minlength="12" maxlength="12" id="phone" name="phone" 
                                        class="form-control @error('phone') is-invalid @enderror" value="" placeholder="Phone (+37064721963)">
                                        @error('phone')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                         <br>
                                    </div>

                                    <div class="from-group">
                                        <input id="email"  name="email"  class="form-control @error('email') is-invalid @enderror"
                                        value="{{Auth::user()->email}}" placeholder="E-Mail">
                                        @error('email')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                         <br>
                                    </div>

                                    <div class="from-group">

                                    <input id="area" name="area" class="form-control @error('area') is-invalid @enderror" value="" placeholder="Area of Woods"><br>
                                    @error('area')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="typeid" id="type" style="width:100%">
                                            <option value="" selected="selected">..Type..</option>
                                            @foreach($config[0] as $key => $type)
                                                <option value="{{$type -> id}}">{{$type -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="ageid" id="age" style="width:100%">
                                            <option value="" selected="selected">..Age..</option>
                                            @foreach($config[1] as $key => $age)
                                                <option value="{{$age -> id}}">{{$age -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div> 

                                    <div class="form-group">
                                        <input id="price" name="price"  
                                        class="form-control @error('price') is-invalid @enderror" value="" placeholder="Price" >
                                        @error('price')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                        <br>
                                    </div>