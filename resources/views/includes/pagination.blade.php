        @php
            $total = ceil($data->total() / $data->perPage());
            $start = $data->currentPage();
            $end = $data->currentPage();

            if ($start - 2 < 0 || $start - 1 < 0)
            {
                $start = 1;
            }
            elseif ($start - 1 == 1)
            {
                $start -= 1;
            }
            else
            {
                $start -= 2;
            }

            if ($end + 2 > $total || $end + 1 > $total)
            {
                $end = $total;
            }
            else
            {
                $end += 2;
            }
        @endphp

        @for($i = $start; $i <= $end; $i++)
            <a class="pagination__link" href="{{$data->url($i)}}">{{$i}}</a> &nbsp;
        @endfor


