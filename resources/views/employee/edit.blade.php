@extends('UI_new.master')
@section('content')
<div class="content-body" style="margin-top: 5em">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page->title}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p><span class="text-bold-600"><i class="la la-info"></i></span> {{$page->section}}</p>

                        <form method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('first_name')) ? old('first_name') : $data->user->first_name
                                    @endphp
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="eg. John" required value="{{ $_value }}">
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('last_name')) ? old('last_name') : $data->user->last_name
                                    @endphp
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="eg. Doe" required value="{{ $_value }}">
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('email')) ? old('email') : $data->user->email
                                    @endphp
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="eg. johndoe@npontu.com" name="email" value="{{ $_value }}"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('phone_number')) ? old('phone_number') :
                                    $data->user->phone_number
                                    @endphp
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="eg. 0244346545"
                                        name="phone_number" id="phone_number" value="{{ $_value }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('country')) ? old('country') : $data->user->country
                                    @endphp
                                    <label for="country">Location (optional)</label>
                                    <input type="text" class="form-control" name="country" id="country"
                                        value="{{ $_value }}">
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('role_id')) ? old('role_id') : $data->role_id
                                    @endphp
                                    <label for="role_id">Role</label>
                                    <select class="form-control" name="role_id" id="role_id" required>
                                        <option value="">-- Select Role ---</option>
                                        @foreach($roles as $item)
                                        <option value="{{ @$item->id }}" {{ $item->id == $_value ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('salary')) ? old('salary') : $data->salary
                                    @endphp
                                    <label for="salary">Salary (optional)</label>
                                    <input type="text" class="form-control" id="salary" placeholder="eg. 2500"
                                        name="salary" value="{{ $_value }}">
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = isset($data->salary_due_date) ? $data->salary_due_date->toDateString() :
                                    "";
                                    $_value = !empty(old('salary_due_date')) ? old('salary_due_date') : $_value;
                                    @endphp
                                    <label for="salary_due_date">Salary Due Date (optional)</label>
                                    <input type="date" class="form-control" name="salary_due_date" id="salary_due_date"
                                        value="{{ $_value }}">
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('salary_reminder')) ? old('salary_reminder') :
                                    $data->salary_reminder
                                    @endphp

                                    <label for="salary_reminder">Salary Reminder</label>
                                    <select class="form-control" name="salary_reminder" id="salary_reminder">
                                        <option value="">-- Select Reminder ---</option>
                                        <option value="monthly" {{ $_value == 'monthly' ? 'selected' : ''}}>Monthly
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-row col-md-12 text-center mt-5">
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
