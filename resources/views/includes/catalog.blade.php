        
        <div class="block">
          <form id="catalogForm" action="{{ route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}" method="GET">
                @if (!empty(request()->input('search')))
                  <input type="hidden" name="search" value="{{ request()->input('search') }}">
                @endif
                @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
							<h4>Category</h4>
							<ul class="filter-list">
              @foreach ($categories as $element)
                <li>
                  <div class="content">
                      <a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fa fa-angle-double-right"></i> {{$element->name}}</a>
                      @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                          @foreach ($cat->subs as $key => $subelement)
                          <div class="sub-content open">
                            <a href="{{route('front.category', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link form-check-label"><i class="fa fa-angle-right"></i>{{$subelement->name}}</a>
                            @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                              @foreach ($subcat->childs as $key => $childcat)
                              <div class="child-content open">
                                <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link form-check-label"><i class="fa fa-caret-right"></i> {{$childcat->name}}</a>
                              </div>
                              @endforeach
                            @endif
                          </div>
                          @endforeach

                        </div>
                      @endif


                </li>
                @endforeach
							</ul>
              <div class="price-range-block">
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                    <div class="livecount">
                      <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                      <span>{{$langg->lang62}}</span>
                      <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                    </div>
                <button class="filter-btn" type="submit">{{$langg->lang58}}</button>
              </div>

                 
          </form>
				</div>

        @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))
          <form id="attrForm" action="{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="post">
          
          @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
              @foreach ($cat->attributes as $key => $attr)
              <div class="block">
                    <h4>{{$attr->name}}</h4>
                    <ul>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                                      
                      <li>									
                        <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                        <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                      </li>
                      @endforeach
                    @endif
                    </ul>
                </div>
              @endforeach
           @endif


           @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
              @foreach ($subcat->attributes as $key => $attr)
              <div class="block">
                    <h4>{{$attr->name}}</h4>
                    <ul>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                                      
                      <li>									
                        <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                        <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                      </li>
                      @endforeach
                    @endif
                    </ul>
                </div>
              @endforeach
           @endif


           @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
              @foreach ($childcat->attributes as $key => $attr)
              <div class="block">
                    <h4>{{$attr->name}}</h4>
                    <ul>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                                      
                      <li>									
                        <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                        <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                      </li>
                      @endforeach
                    @endif
                    </ul>
                </div>
              @endforeach
           @endif





          </form>
        
        
        @endif
        
        
        
       
