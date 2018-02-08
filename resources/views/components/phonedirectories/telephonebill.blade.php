<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p class="mb-0">
        <strong>
            <em>All Telephone Bills for Personal Calls will be automatically populated after 10days identification Window has expired</em>
        </strong>
    </p>
</div>
<div id="billAccordion" role="tablist" aria-multiselectable="true">
    <?php $show_month_bill = 'show'; ?>
    @foreach($months_of_user_phone_bill as $month)
    <div class="card">
        <div class="card-header" role="tab" id="heading{{ str_replace(' ','',$month->date) }}">
            <h5 class="mb-0">
                <a class="btn btn-secondary btn-sm collapsed" data-toggle="collapse" data-parent="#billAccordion" href="#collapse{{ str_replace(' ','',$month->date) }}" aria-expanded="false" aria-controls="collapse{{ str_replace(' ','',$month->date) }}">
                    {{$month->date}}
                </a>
            </h5>
        </div>
        <div id="collapse{{ str_replace(' ','',$month->date) }}" class="collapse {{ $show_month_bill }}" role="tabpanel" aria-labelledby="heading{{ str_replace(' ','',$month->date) }}">
            <div class="card-block">
                @if($all_users_phone_bill->contains('date',$month->date))
                <table class="table table-sm table-striped">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Staff Name</th>
                            <th class="text-center">Extension</th>
                            <th class="text-center">Service Offered</th>
                            <th class="text-center">Call Type</th>
                            <th class="text-center">Total Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_users_phone_bill as $user_phone_bill)
                        <?php $date = new Jenssegers\Date\Date($user_phone_bill->date); ?>
                        @if($date->format('F Y') == $month->date)
                        <tr>
                            <td class="font-italic">{{ $user_phone_bill->user_name }}</td>
                            <td class="text-center font-italic">{{ $user_phone_bill->ext_no }}</td>
                            <td class="text-center font-italic">Telephone Services</td>
                            <td class="text-center font-italic">Personal Calls</td>
                            <td class="text-center font-italic">{{ number_format($user_phone_bill->total_cost,2,".",",")."/=" }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <thead class="thead-inverse">
                        <tr>
                            <th colspan="2" class="text-center font-italic">Total Bill</th>
                            <th colspan="3" class="text-center font-italic">
                                <?php $total_bill = 0; ?>
                                @foreach($all_users_phone_bill_total_cost as $monthly_total_bill)
                                @if($monthly_total_bill->date == $month->date)
                                <?php $total_bill = $monthly_total_bill->total_cost; ?>
                                @endif
                                @endforeach
                                {{ number_format($total_bill,2,".",",")."/=" }}
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
                            <em>Telephone Bill for this Month has not been generated</em>
                        </strong>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <?php $show_month_bill = ''; ?>
    @endforeach
</div>