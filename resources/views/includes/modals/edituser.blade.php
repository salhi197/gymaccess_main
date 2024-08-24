<div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Modifier user</h3>
            </div>
            <div class="modal-body">
                <!----------------------------------------------------------------------->
                <form action="{{route('user.update',['user'=>$user])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Grade : </label>
                        <select name="grade" class="customselect">
                            <option @if($user->isadmin==1) selected @endif value="1">
                                Admin
                            </option>
                            <option @if($user->isadmin==2) selected @endif value="2">
                                Caisse 
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Genre : </label>
                        <select name="genre" class="customselect">
                            <option value="">Séléctionner</option>

                            <option value="homme">
                                homme
                            </option>
                            <option value="femme">
                                femme
                            </option>
                            <option value="mixte">
                                mixte
                            </option>
                            <option value="enfant">
                                enfant
                            </option>

                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Login : </label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="nom"
                            placeholder="Login ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password : </label>
                        <input type="text" class="form-control" value="{{ $user->password_text }}" name="password" id="password"
                            placeholder="Mot de passe">
                    </div>
                    <button class="btn bubbly-button btn-block" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
