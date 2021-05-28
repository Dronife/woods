<div class="form-group">

                            <div class="form-group">
                                <input placeholder="Enter Username..." id="username" type="username" class="form-control @error('username') is-invalid @enderror"
                                 name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            

                            <div class="form-group">
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="form-group">
                                <button 
                                type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>


                               <div class="text-center">
                                   
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                            {{ __('Do not have account? Create one!') }}
                                    </a>
                               </div>
                            </div>
                        </div>