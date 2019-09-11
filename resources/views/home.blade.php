@include('./user/header')
<div class="container cardPosition">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">                    
                    <form id="form_validation" method="POST" class="form wizard clearfix" action="{{ route('sectionSelect')}}">
                        <div class="steps clearfix">
                            <ul role="tablist">
                                <li role="tab" class="first current" aria-disabled="false" aria-selected="true" style="width: 50%;">
                                    <a>
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">1.</span> Section
                                    </a>
                                </li>
                                <li role="tab" class="disabled last" aria-disabled="true" style="width: 50%;">
                                    <a>
                                        <span class="number">2.</span> Question
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="content clearfix">
                            <h2 class="text-center">Dispatch Log</h2>
                            <h3 class="title current">Section</h3>
                            <fieldset class="body current" id="userFirstForm">
                                 <!-- Select -->                                    
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="event">Event<span class="error">&nbsp;*</span></label>
                                        <select name="section" class="form-control show-tick" required>
                                            <option value="" selected="">-- Please select --</option>
                                            @foreach($users as $user)
                                                <option>{{ $user->section }}</option> 
                                            @endforeach                                           
                                        </select>
                                    </div>
                                </div>
                                <!-- #END# Select -->
                            </fieldset>

                            <h3 class="title">Question</h3>
                            <fieldset class="body"  style="display: none;">
                            </fieldset>
                        </div>
                        <div class="actions clearfix">
                            <ul>
                                <li>
                                    <button type="submit" class="btn bg-indigo waves-effect"><i class="material-icons">trending_up</i>&nbsp;<span class="nextButton">Next</span></button>
                                </li>
                                <li aria-hidden="true" style="display: none;">
                                    <a href="#finish" role="menuitem" class="waves-effect">Finish</a>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('./user/footer')

