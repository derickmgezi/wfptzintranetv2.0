<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <!--                        <h4 class="alert-heading">Billing of Private Calls</h4>-->
    <p>
        Please identify your <stong>Official</stong> and <stong>Private</stong> calls by clicking on the respectable Type field button
</p>
<p class="mb-0">
    <strong>
        <em>You have a window of 10days to identify your calls once you receive a notification from Admin 
            (except for staff on leave or official travel), failure to do so all unidentified calls will
            be deemed to be personal and will be billed accordingly</em>
    </strong>
</p>
</div>
<div id="userBillAccordion" role="tablist" aria-multiselectable="true">
    <?php $show_user_month_bill = 'show'; ?>
    @foreach($months_of_user_phone_bill as $month)
    <div class="card">
        <div class="card-header" role="tab" id="userHeading{{ str_replace(' ','',$month->date) }}">
            <h5 class="mb-0">
                <a class="btn btn-secondary btn-sm collapsed" data-toggle="collapse" data-parent="#userBillAccordion" href="#userCollapse{{ str_replace(' ','',$month->date) }}" aria-expanded="false" aria-controls="userCollapse{{ str_replace(' ','',$month->date) }}">
                    {{$month->date}}
                </a>
            </h5>
        </div>
        <div id="userCollapse{{ str_replace(' ','',$month->date) }}" class="collapse {{ $show_user_month_bill }}" role="tabpanel" aria-labelledby="userHeading{{ str_replace(' ','',$month->date) }}">
            <div class="card-block">
                @if($user_phone_bill->contains('date',$month->date))
                <table class="table table-sm table-striped">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Number</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Date Time</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Costs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_phone_bill as $bill)
                        <?php $date = new Jenssegers\Date\Date($bill->date_time); ?>
                        @if($date->format('F Y') == $month->date)
                        <tr>
                            <td class="font-italic">{{ $bill->number }}</td>
                            <td class="text-center">
                                <?php $upload_date = new Jenssegers\Date\Date($bill->created_at); ?>
                                @if($upload_date->diffInDays() <= 14)
                                <a href="{{URL::to('/private/'.$bill->id)}}" class="btn btn-primary btn-sm @if($bill->type == 'Private'){{ 'disabled' }}@endif">Private</a>
                                <a href="{{URL::to('/public/'.$bill->id)}}" class="btn btn-success btn-sm @if($bill->type == 'Official'){{ 'disabled' }}@endif">Official</a>
                                @else
                                @if($bill->type == 'Official')
                                <a href="#" class="btn btn-success btn-sm disabled">Official</a>
                                @else
                                <a href="#" class="btn btn-primary btn-sm disabled">Private</a>
                                @endif
                                @endif
                            </td>
                            <td class="text-center font-italic">{{ $bill->date_time }}</td>
                            <td class="text-center font-italic">{{ $bill->duration }}</td>
                            <td class="text-center font-italic">{{ number_format($bill->cost,2,".",",")."/=" }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <thead class="thead-inverse">
                        <tr>
                            <th colspan="2" class="text-center font-italic">Total Bill</th>
                            <th colspan="3" class="text-center font-italic">
                                <?php $total_user_bill = 0; ?>
                                @foreach($user_phone_bill_total_cost as $monthly_user_bill)
                                @if($monthly_user_bill->date == $month->date)
                                <?php $total_user_bill = $monthly_user_bill->total_cost; ?>
                                @endif
                                @endforeach
                                {{ number_format($total_user_bill,2,".",",")."/=" }}
                            </th>
                        </tr>
                    </thead>
                </table>
                @else
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>
                        <strong>
                            <em>You don't have a Telephone Bill for this Month</em>
                        </strong>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <?php $show_user_month_bill = ''; ?>
    @endforeach
</div>