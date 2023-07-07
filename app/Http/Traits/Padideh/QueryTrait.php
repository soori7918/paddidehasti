<?php


namespace App\Http\Traits\Padideh;

use App\Models\DeliWed\CashRequest;
use App\Models\DeliWed\Contract;
use App\Models\DeliWed\ContractType;
use App\Models\DeliWed\Facility;
use App\Models\DeliWed\FacilityMedia;
use App\Models\DeliWed\Location;
use App\Models\DeliWed\Package;
use App\Models\DeliWed\Portfolios\Banner;
use App\Models\DeliWed\Portfolios\Portfolio;
use App\Models\DeliWed\Portfolios\PortfolioBlog;
use App\Models\DeliWed\Portfolios\PortfolioCategory;
use App\Models\DeliWed\Portfolios\PortfolioContent;
use App\Models\DeliWed\UserAlert;
use App\Models\DeliWed\Voucher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


trait QueryTrait
{
    public function createQuery($data)
    {
        $query = $this->makeSimpleQuery($data['type']);

//        $start_date = $this->checkRequestDate($request, 'start_date', $data['start_date']);
//        $end_date= $this->checkRequestDate($request, 'end_date', $data['end_date']);

        if (isset($data['sort']) and isset($data['sort']['field'])) {
            $this->setSortToQuery($data['type'], $query, $data['sort'] );
        }
        if (isset($data['query']) and !empty($data['query'])) {
            $this->setFiltersToQuery($data['type'], $query, json_decode($data['query']));
        }
        if(!isset($data['sort'])) {
            $query->orderByDesc('updated_at');
        }
        return $query->paginate($data['request']->perpage);
    }

    public function setSortToQuery($type, $query, $sort)
    {
        if (isset($sort['field']) and $sort['field'] != 'actions')
            $query->orderBy($sort['field'], $sort['sort']);

    }

    public function setFiltersToQuery($type, $query, $queries)
    {
        switch ($type) {
                case User::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'mobile_number':
                                    $query->where('mobile_number', 'like', '%'.convertNumbers($row->value, false).'%');
                                    break;
                                case 'name':
                                    $query->where('first_name', 'like', '%'.$row->value.'%');
                                    break;
                    }
                    } // end of foreach
                    break;
                case Contract::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                        case 'user_name':
                            $query->whereHas('user' ,function (Builder $query) use ($row) {
                                return $query->where('first_name', 'like', '%'.$row->value.'%' );
                            });
                            break;
                        case 'mobile_number':
                            $query->whereHas('user' ,function (Builder $query) use ($row) {
                                return $query->where('mobile_number', 'like', '%'.$row->value.'%' );
                            });
                            break;
                        case 'type':
                            $query->where('type_id', $row->value);
                            break;
                        case 'date_from':
                            $query->where('service_date', '>=', $row->value);
                            break;
                        case 'date_to':
                            $query->where('service_date', '<=', $row->value);
                            break;
                    }
                    } // end of foreach
                    break;
                case Facility::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                                case 'parent_id':
                                    $query->where('parent_id', intval($row->value));
                                    break;
                            }
                    } // end of foreach
                    break;
                case Package::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                                case 'price':
                                    $query->where('price', intval(removeFromNumber($row->value, false)));
                                    break;
                            }
                    } // end of foreach
                    break;
                case Banner::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                            } //end of inner switch
                    } // end of foreach
                    break;
                case PortfolioCategory::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                            } //end of inner switch
                    } // end of foreach
                    break;
                case PortfolioContent::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                            } //end of inner switch
                    } // end of foreach
                    break;
                case PortfolioBlog::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'title':
                                    $query->where('title', 'like', '%'.$row->value.'%' );
                                    break;
                            } //end of inner switch
                    } // end of foreach
                    break;
                    case Voucher::class:
                    foreach ($queries as $row) {
                        if (isset($row->key) and isset($row->value))
                            switch ($row->key) {
                                case 'code':
                                    $query->where('code', 'like', '%'.$row->value.'%' );
                                    break;
                            } //end of inner switch
                    } // end of foreach
                    break;
            case CashRequest::class:
                foreach ($queries as $row) {
                    if (isset($row->key) and isset($row->value))
                        switch ($row->key) {
                            case 'name':
                                $query->whereHas('user', function (Builder $query) use ($row){
                                    return $query->where('first_name', 'like', '%'.$row->value.'%' )
                                        ->orWhere('last_name', 'like', '%'.$row->value.'%' );
                                });
                                break;
                            case 'mobile_number':
                                $query->whereHas('user', function (Builder $query) use ($row){
                                    return $query->where('mobile_number', 'like', '%'.$row->value.'%' );
                                });
                                break;
                        } //end of inner switch
                } // end of foreach
                break;

                }//end of switch
    }

    public function createCondition($column, $condition, $data)
    {
        if ($condition) {
            return [$column, $condition, $data];
        }

        return [$column, $data];
    }

    public function makeSimpleQuery($type)
    {
        $query = '';
        switch ($type){
            case User::class:
                $query = User::query();
                break;
            case Contract::class:
                $query = Contract::with(['user', 'type', 'status', 'location.medias', 'imageProcess', 'videoProcess', 'facilities']);
                break;
            case ContractType::class:
                $query = ContractType::query();
                break;
            case Facility::class:
                $query = Facility::with(['media','parent']);
                break;
            case Package::class:
                $query = Package::with(['facilities']);
                break;
            case Location::class:
                $query = Location::with('medias')->whereNull('user_id');
                break;
            case UserAlert::class:
                $query = UserAlert::with('user');
                break;
            case Banner::class:
                $query = Banner::query();
                break;
            case PortfolioCategory::class:
                $query = PortfolioCategory::with('category');
                break;
            case PortfolioContent::class:
                $query = PortfolioContent::with('category');
                break;
            case CashRequest::class:
                $query = CashRequest::with('user');
                break;
            case PortfolioBlog::class:
                $query = PortfolioBlog::query();
                break;
            case Portfolio::class:
                $query = Portfolio::query();
                break;
            case FacilityMedia::class:
                $query = FacilityMedia::query();
                break;
            case Voucher::class:
                $query = Voucher::query();
                break;
        }

        return $query;
    }

    public function makeDate($type, $day)
    {
        switch ($type){
            case 'start_date':
                return Carbon::now()->timezone('Asia/Tehran')->addDays($day)->format('Y-m-d') .' '.'00:00:00';
            case 'end_date':
                return Carbon::now()->timezone('Asia/Tehran')->addDays($day)->format('Y-m-d') .' '.'23:59:59';
            default:
                return Carbon::now()->timezone('Asia/Tehran')->format('Y-m-d');
        }
    }

    public function convertDateToGregorian($type, $date)
    {
        $t_date = explode(" ",persianDateToGregorian(convertNumbers($date.' '.'08:00:00',false)));
        switch($type){
            case 'start_date':
                return $t_date[0].' '.'00:00:00';
            case 'end_date':
                return $t_date[0].' '.'23:59:59';
            default:
                return $t_date[0].' '.'00:00:00';
        }
    }

    public function convertDateToPersianFormat($delimeter, $date)
    {
        switch ($delimeter){
            case '/':
                return convertNumbers(Verta($date)->timezone('Asia/Tehran')->format('Y/m/d'),true);
            case '-':
                return convertNumbers(Verta($date)->timezone('Asia/Tehran')->format('Y-m-d'),true);
            default:
                return convertNumbers(Verta($date)->timezone('Asia/Tehran')->format('Y-m-d'),true);
        }
    }

    public function checkRequestDate( $request, $type, $day = null)
    {
        $date ='';
        switch ($type){
            case 'start_date':
                if ($request->filled('start_date')){
                    $date = $this->convertDateToGregorian('start_date', $request->start_date);
                }else{
                    $date = $this->makeDate('start_date',$day);
                    $request->merge(['start_date' => $this->convertDateToPersianFormat('/', $date)]);
                }
                break;
            case 'end_date':
                if ($request->filled('end_date')){
                    $date = $this->convertDateToGregorian('end_date', $request->end_date);
                }else{
                    $date = $this->makeDate('end_date',$day);
                    $request->merge(['end_date' => $this->convertDateToPersianFormat('/', $date)]);
                }
                break;
            case 'one_day_start':
                if ($request->filled('start_date')){
                    $date = $this->convertDateToGregorian('start_date', $request->start_date);
                }
                break;
            case 'one_day_end':
                if ($request->filled('start_date')){
                    $date = $this->convertDateToGregorian('end_date', $request->start_date);
                }
                break;
            default:
                $date = $this->makeDate('start_date',$day);
                $request->merge(['start_date' => $this->convertDateToPersianFormat('/', $date)]);
        }

        return $date;
    }

    public function setDateToQuery($query, $date, $model, $type)
    {
        switch ($model){
            case 'PasmandOrderHead':
                if($type == 'start_date'){
                    return $query->where('date_time_daryaft','>=',$date);
                }elseif($type == 'end_date'){
                    return $query->where('date_time_daryaft','<=',$date);
                }
                break;
            case 'PasmandOrder':
                if($type == 'start_date'){
                    return $query->whereHas('pasmandOrderHead', function (Builder $query) use ($date){
                        return $query->where('date_time_daryaft','>=',$date);
                    });
                }elseif($type == 'end_date'){
                    return $query->whereHas('pasmandOrderHead', function (Builder $query) use ($date){
                        return $query->where('date_time_daryaft','<=',$date);
                    });
                }elseif($type == 'start_end_date'){
                    return $query->whereHas('pasmandOrderHead', function (Builder $query) use ($date){
                        return $query->where('date_time_daryaft','<=',$date);
                    });
                }
                break;
            case 'PasmandWayBill':
                if($type == 'start_date'){
                    return $query->whereHas('head', function (Builder $query) use ($date){
                        return $query->where('way_bill_date','>=',$date);
                    });
                }elseif($type == 'end_date'){
                    return $query->whereHas('head', function (Builder $query) use ($date){
                        return $query->where('way_bill_date','<=',$date);
                    });
                }
                break;
            case 'wayBillHead':
                if($type == 'start_date'){
                    return $query->where('way_bill_date','>=',$date);
                }elseif($type == 'end_date'){
                    return $query->where('way_bill_date','<=',$date);
                }
                break;
            case 'buy-product':
                if($type == 'start_date'){
                    return $query->where('buy_date','>=',$date);
                }elseif($type == 'end_date'){
                    return $query->where('buy_date','<=',$date);
                }
                break;
            case 'users':
                if($type == 'start_date'){
                    return $query->where('created_at','>=',$date);
                }elseif($type == 'end_date'){
                    return $query->where('created_at','<=',$date);
                }
                break;
        }
    }

    public function setFilterQueryByRequest($request, $query, $type)
    {
        switch ($type){
            case 'pasmandOrderHead':
                if ($request->filled('search_type') && $request->filled('search')){
                    if($request->get('search_type') == 'marketer_lname') {
                        $users = User::where('last_name','LIKE', '%'.$request->search.'%')->with('userRoleCustomer.customer')->select('id')->get();
                        $ids = $this->getMarketerCustomersUsers($users);
                        $query->whereIn('user_id', $ids);
                    }elseif($request->get('search_type') == 'driver_mobile'){
                        $query->whereHas('pasmandDriver.role.user', function (Builder $query) use($request){
                            $query->where('mobile_number', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif ($request->get('search_type') != 'order_code') {
                        $query->whereHas('user', function (Builder $query) use($request){
                            $query->where($request->search_type, 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'order_code'){
                        $query->where('code',$request->get('search'));
                    }
                }
                break;
            case 'negotiation-users':
                if ($request->filled('search_type') && $request->filled('search')){
                    if($request->get('search_type') == 'mobile_number') {
                        $query->where('mobile_number', 'like', '%'.$request->search.'%');
                    }elseif($request->get('search_type') == 'first_name') {
                        $query->where('first_name', 'like', '%'.$request->search.'%');
                    }elseif($request->get('search_type') == 'last_name'){
                        $query->where('last_name', 'like', '%'.$request->search.'%');
                    }elseif ($request->get('search_type') == 'marketer_last_name') {
                        $users = User::where('last_name','LIKE', '%'.$request->search.'%')->with('userRoleCustomer.customer')->select('id')->get();
                        $ids = $this->getMarketerCustomersUsers($users);
                        $query->whereIn('id', $ids);
                    }
                }
                break;
            case 'customer-percents':
                if ($request->filled('search_type') && $request->filled('search')){
                    if($request->get('search_type') == 'mobile_number') {
                        $query->whereHas('customer.role.user', function (Builder $query) use($request){
                            return $query->where('mobile_number', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'first_name'){
                        $query->whereHas('customer.role.user', function (Builder $query) use($request){
                            return $query->where('first_name', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'last_name'){
                        $query->whereHas('customer.role.user', function (Builder $query) use($request){
                            return $query->where('last_name', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'marketer_first_name'){
                        $query->whereHas('customer.referral.role.user', function (Builder $query) use($request){
                            return $query->where('first_name', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'marketer_last_name'){
                        $query->whereHas('customer.referral.role.user', function (Builder $query) use($request){
                            return $query->where('last_name', 'LIKE', '%' . $request->search . '%');
                        });
                    }elseif($request->get('search_type') == 'marketer_mobile'){
                        $query->whereHas('customer.referral.role.user', function (Builder $query) use($request){
                            return $query->where('mobile_number', 'LIKE', '%' . $request->search . '%');
                        });
                    }
                }
                break;
        }
        return $query;
    }

}
