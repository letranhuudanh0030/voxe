<?php

// Start function route 

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

function ProductCategoryRoute($category)
{
    return route('categoryP', ['slug' => $category->slug, 'id'=> $category->id]);
}

function ProductDetailRoute($product)
{
    return route('single', ['slug' => $product->slug, 'id'=> $product->id]);
}

function ArticleCategoryRoute($category)
{
    return route('categoryA', ['slug' => $category->slug, 'id'=> $category->id]);
}

function ArticleDetailRoute($article)
{
    return route('news', ['slug' => $article->slug, 'id'=> $article->id]);
}
// End function route


function showCategories($categories, $category = null, $parent_id = 0, $char = '', $id = null)
{
    
    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            if (isset($category)) {
                $opt = '<option value="' . $item->id . '" data-chained="product_catalogua"';
                // if($category->id == $item->id){
                //     $opt.='hidden';
                // }
                if ($category->parent_id == $item->id) {
                    $opt .= 'selected >';
                } else {
                    $opt .= '>';
                }

                $opt .= $char . $item->name;
                $opt .= '</option>';
                echo $opt;
            } else if (isset($id)) {
                $opt = '<option value="' . $item->id . '" data-chained="product_catalogua"';
                if ($id == $item->id) {
                    $opt .= 'selected >';
                } else {
                    $opt .= '>';
                }
                $opt .= $char . $item->name;
                $opt .= '</option>';
                echo $opt;
            } else {

                echo '<option value="' . $item->id . '" data-chained="product_catalogua">';
                echo $char . $item->name;
                echo '</option>';
            }

            // Xóa chuyên mục đã lặp
            unset($categories->id);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $category, $item->id, $char . '|---', $id);
        }
    }
}

function showlevel($categories, $category = null, $parent_id = 0, $char = '')
{

    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            if (isset($category)) {

                if ($category->id == $item->id) {
                    echo count(explode('|', $char));
                }
            }

            // Xóa chuyên mục đã lặp
            unset($categories->id);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showlevel($categories, $category, $item->id, $char . '|---');
        }
    }
}

function ShowTable($categories, $parent_id = 0, $char = '')
{

    foreach ($categories as $key => $item) {
        // dd($parent_id);
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            // echo $char . $item['title'];
            echo '<tr class="text-center nb-tr-' . $item->id . '" data-url="' . route('product-type.status') . '">';
            echo '<td>' . $item->id . '</td>';
            echo '<td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check-'.$key.'" data-id="'.$item->id.'">
                        <label class="custom-control-label" for="check-'.$key.'"></label>
                    </div>
                </td>';
            echo '<td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">' . $char . $item->name . '</a></td>';
            echo '<td>';
            if ($item->parent_id == 0) {
                echo 'Loại cha';
            } else {
                echo $categories->where('id', $item->parent_id)->first()->name;
            }
            echo '</td>';
            echo '<td><a href="' . route('products.cate', $item->id) . '" class="text-danger text-decoration-none">' . $item->products->count() . '</a></td>';
            echo '<td><input type="text" class="nb-sort-order sort-order-' . $key . '" value="' . $item->sort_order . '" id="' . $item->id . '" name="sort_order"></td>';
            echo '<td>' . date('H:i d-m-Y', strtotime($item->created_at)) . '</td>';
            echo '<td>';
            if ($item->publish) {
                echo '<span class="nb-check-publish-' . $key . ' nb-check nb-publish-status" data-change="0" id="' . $item->id . '" title="Status" data-name="publish"><i class="fa fa-check fa-lg text-success"></i></span>';
            } else {
                echo '<span class="nb-check-publish-' . $key . ' nb-check nb-publish-status" data-change="1" id="' . $item->id . '" title="Status"  data-name="publish"><i class="fa fa-remove fa-lg text-secondary"></i></span>';
            }
            echo '</td>';
            echo '<td>';
            if ($item->highlight) {
                echo '<span class="nb-check-highlight-' . $key . ' nb-check nb-highlight-status" data-change="0" id="' . $item->id . '" title="Status" data-name="highlight"><i class="fa fa-check fa-lg text-success"></i></span>';
            } else {
                echo '<span class="nb-check-highlight-' . $key . ' nb-check nb-highlight-status" data-change="1" id="' . $item->id . '" title="Status"  data-name="highlight"><i class="fa fa-remove fa-lg text-secondary"></i></span>';
            }
            echo '</td>';
            echo '<td>';
            if (Auth::user()->permission_id == 0) {
                if($item->parent_id != 0){

                    echo '<a href="void:javascript(0)" title="Delete" class="nb-row-' . $key . ' nb-delete" data-id="' . $item->id . '" data-url="' . route('product-type.remove') . '"><i class="fa fa-trash text-danger nb-cta-action"></i></a>';
                }
            }
            echo '<a href="' . route('product-type.edit', $item->id) . '" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>';
            echo '</td>';

            echo '</tr>';

            // Xóa chuyên mục đã lặp
            unset($categories->id);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            ShowTable($categories, $item->id, $char . '|---');
        } 
    }
}

function trackIp()
{
    $dir = storage_path() . '\visitors';
    $tomorrow  = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
    $currentDay  = mktime(0, 0, 0, date("m"), date("d") + 2, date("Y"));
    $countDefaultToday = 20;
    // $currentDay = strtotime(date('Y-m-d H:i:s'));




    // dd($dir);
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
    }
    $file = 'visit_log.txt';
    $ip = $_SERVER['REMOTE_ADDR'];
    $filename = $dir . '/' . $file;

    $info = $ip . ',';
    file_put_contents($filename, $info, FILE_APPEND);


    $fp = $dir . '/' . $file;
    $fo = fopen($fp, 'r');
    $fr = fread($fo, filesize($fp));
    $fArr = explode(',', $fr);
    $count = 0;
    foreach ($fArr as $key => $value) {
        if ($value != '') {
            $count++;
        }
    }

    echo 'Trực tuyến: ' . (3) . ' | Hôm nay: ' . number_format(20 + $count) . ' | Tổng truy cập: ' . number_format((2000 + $count)) . '';
}

function counter()
{
    // settings

    // ip-protection in seconds
    $counter_expire = 600;
    $counter_filename = storage_path() . "/visitors/counter.txt";

    // ignore agent list
    $counter_ignore_agents = array('bot', 'bot1', 'bot3');

    // ignore ip list
    $counter_ignore_ips = array('127.0.0.2', '127.0.0.3');


    // get basic information
    $counter_agent = $_SERVER['HTTP_USER_AGENT'];
    $counter_ip = $_SERVER['REMOTE_ADDR'];
    $counter_time = time();


    if (file_exists($counter_filename)) {
        // check ignore lists
        $ignore = false;

        $length = sizeof($counter_ignore_agents);
        for ($i = 0; $i < $length; $i++) {
            if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i]))) {
                $ignore = true;
                break;
            }
        }

        $length = sizeof($counter_ignore_ips);
        for ($i = 0; $i < $length; $i++) {
            if ($counter_ip == $counter_ignore_ips[$i]) {
                $ignore = true;
                break;
            }
        }



        // get current counter state
        $c_file = array();
        $fp = fopen($counter_filename, "r");

        if ($fp) {
            //flock($fp, LOCK_EX);
            $canWrite = false;
            while (!$canWrite)
                $canWrite = flock($fp, LOCK_EX);

            while (!feof($fp)) {
                $line = trim(fgets($fp, 1024));
                if ($line != "")
                    $c_file[] = $line;
            }
            flock($fp, LOCK_UN);
            fclose($fp);
        } else {
            $ignore = true;
        }


        // check for ip lock
        if ($ignore == false) {
            $continue_block = array();
            for ($i = 1; $i < sizeof($c_file); $i++) {
                $tmp = explode("||", $c_file[$i]);

                if (sizeof($tmp) == 2) {
                    list($counter_ip_file, $counter_time_file) = $tmp;
                    $counter_time_file = trim($counter_time_file);

                    if ($counter_ip == $counter_ip_file && $counter_time - $counter_expire < $counter_time_file) {
                        // do not count this user but keep ip
                        $ignore = true;

                        $continue_block[] = $counter_ip . "||" . $counter_time;
                    } else if ($counter_time - $counter_expire < $counter_time_file) {
                        $continue_block[] = $counter_ip_file . "||" . $counter_time_file;
                    }
                }
            }
        }

        // count now
        if ($ignore == false) {
            // increase counter
            if (isset($c_file[0]))
                $tmp = explode("||", $c_file[0]);
            else
                $tmp = array();

            if (sizeof($tmp) == 8) {
                // prevent errors
                list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = $tmp;

                $day_data = explode(":", $day_arr);
                $yesterday_data = explode(":", $yesterday_arr);

                // yesterday
                $yesterday = $yesterday_data[1];
                if ($day_data[0] == (date("z") - 1)) {
                    $yesterday = $day_data[1];
                } else {
                    if ($yesterday_data[0] != (date("z") - 1)) {
                        $yesterday = 0;
                    }
                }

                // day
                $day = $day_data[1];
                if ($day_data[0] == date("z")) $day++;
                else $day = 1;

                // week
                $week_data = explode(":", $week_arr);
                $week = $week_data[1];
                if ($week_data[0] == date("W")) $week++;
                else $week = 1;

                // month
                $month_data = explode(":", $month_arr);
                $month = $month_data[1];
                if ($month_data[0] == date("n")) $month++;
                else $month = 1;

                // year
                $year_data = explode(":", $year_arr);
                $year = $year_data[1];
                if ($year_data[0] == date("Y")) $year++;
                else $year = 1;

                // all
                $all++;

                // neuer record?
                $record_time = trim($record_time);
                if ($day > $record) {
                    $record = $day;
                    $record_time = $counter_time;
                }

                // speichern und aufräumen und anzahl der online leute bestimmten
                $online = 1;

                // write counter data (avoid resetting)
                if ($all > 1) {
                    $fp = fopen($counter_filename, "w+");
                    if ($fp) {
                        //flock($fp, LOCK_EX);
                        $canWrite = false;
                        while (!$canWrite)
                            $canWrite = flock($fp, LOCK_EX);

                        $add_line1 = date("z") . ":" . $day . "||" . (date("z") - 1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";
                        fwrite($fp, $add_line1);

                        $length = sizeof($continue_block);
                        for ($i = 0; $i < $length; $i++) {
                            fwrite($fp, $continue_block[$i] . "\n");
                            $online++;
                        }

                        fwrite($fp, $counter_ip . "||" . $counter_time . "\n");
                        flock($fp, LOCK_UN);
                        fclose($fp);
                    }
                } else {
                    $online = 1;
                }
            } else {
                // show data when error  (of course these values are wrong, but it prevents error messages and prevent a counter reset)

                // get counter values
                $yesterday = 0;
                $day = $week = $month = $year = $all = $record = 1;
                $record_time = $counter_time;
                $online = 1;
            }
        } else {
            // get data for reading only
            if (sizeof($c_file) > 0)
                list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
            else
                list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z") - 1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $counter_time);

            // day
            $day_data = explode(":", $day_arr);
            $day = $day_data[1];

            // yesterday
            $yesterday_data = explode(":", $yesterday_arr);
            $yesterday = $yesterday_data[1];

            // week
            $week_data = explode(":", $week_arr);
            $week = $week_data[1];

            // month
            $month_data = explode(":", $month_arr);
            $month = $month_data[1];

            // year
            $year_data = explode(":", $year_arr);
            $year = $year_data[1];

            $record_time = trim($record_time);

            $online = sizeof($c_file) - 1;
            if ($online <= 0)
                $online = 1;
        }
    } else {
        // create counter file
        $add_line = date("z") . ":1||" . (date("z") - 1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $counter_time . "\n" . $counter_ip . "||" . $counter_time . "\n";

        // write counter data
        $fp = fopen($counter_filename, "w+");
        if ($fp) {
            //flock($fp, LOCK_EX);
            $canWrite = false;
            while (!$canWrite)
                $canWrite = flock($fp, LOCK_EX);

            fwrite($fp, $add_line);
            flock($fp, LOCK_UN);
            fclose($fp);
        }

        // get counter values
        $yesterday = 0;
        $day = $week = $month = $year = $all = $record = 1;
        $record_time = $counter_time;
        $online = 1;
    }


    // echo 'Trực tuyến: ' . $online . ' | Hôm nay: ' . $day . ' | Tổng truy cập: ' . $all . '';
    $tracking = [];
    $tracking['online'] = $online;
    $tracking['today'] = $day;
    $tracking['total'] = $all;
    // dd($tracking);
    return $tracking;
}

function tranlateAddress($str){
    if(Lang::locale() == 'en'){

        $text = vn_to_str($str);
        $text = str_replace('Tinh', 'Province,', $text);
        $text = str_replace('Thanh pho', 'City,', $text);
        $text = str_replace(['Huyen', 'Quan', 'Thi xa'], 'District,', $text);
        $text = str_replace(['Phuong', 'Xa', 'Thi tran'], 'Ward,', $text);
        // $text = str_replace('Huyen', 'District,', $text);
        $text = explode(',', $text);
        
        $str_convert = $text[1].' '.$text[0]; 
        // dd($text[1].' '.$text[0]);
        return $str_convert;
    } else {
        return $str;
    }
}

function vn_to_str ($str){
 
    $unicode = array(
     
    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
     
    'd'=>'đ',
     
    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
     
    'i'=>'í|ì|ỉ|ĩ|ị',
     
    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
     
    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
     
    'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     
    'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     
    'D'=>'Đ',
     
    'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
     
    'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     
    'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     
    'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     
    'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
     
    );
     
    foreach($unicode as $nonUnicode=>$uni){
     
    $str = preg_replace("/($uni)/i", $nonUnicode, $str);
     
    }
    $str = str_replace(' ',' ',$str);
     
    return $str;
     
}
