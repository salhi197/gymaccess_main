                        <div class="modal fade" id="renouvler" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content model1">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Renouvler Inscription:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @if($inscription->total-$inscription->versement!=0)
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="exampleModalLabel">Ce Membre a un montant à payer :{{$inscription->total-$inscription->versement}} DA</h5>
                                    </div>
                                    @endif



                                    <div class="modal-body">
                                        <form role="form" action="{{route('inscription.store')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" value="{{$membre->id ?? ''}}" name="membre2" />
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Nombre de mois</label>
                                                        <input type="number"  value="{{old('nbrmois') ?? 1}}" min="1"  id="nbrmois2" name="nbrmois2" class="form-control">
                                                    </div>
                                                    
                                                </div>


                                                    

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Abonnement</label>
                                                        <select class="customselect" id="abonnement2" name="abonnement2">
                                                            <option >Séléctionner un Abonnement</option>
                                                                @foreach($abonnements as $abonnement)
                                                                    <option value="{{$abonnement}}">{{$abonnement->label}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Date début</label>
                                                        <input type="date" id="debut2"  value="{{Date('Y-m-d')}}" name="debut2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Tarification:</label>
                                                        <input type="number"  onkeydown="return false;" name="tarif2"  value="0" id="tarif2" class="form-control">
                                                    </div>                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remise</label>
                                                        <input type="number" value="{{old('remise') ?? 0}}" id="remise2" name="remise2" class="form-control">
                                                    </div>                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Total Final : </label>
                                                        <input type="number" value="{{old('ttc') ?? 0}}" onkeydown="return false;" id="total2" name="total2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Versement</label>
                                                        <input type="number"  value="{{old('versement') ?? 0}}" id="versement2" name="versement2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Reste</label>
                                                        <input type="number"  value="{{old('reste') ?? 0}}" onkeydown="return false;" id="reste2" name="reste2" class="form-control">
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" id="valider2"  class="btn btn-info btn-block">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
