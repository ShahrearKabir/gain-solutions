# gain-solutions
 assignment
 
Database file added in database folder. OR Migrate and add new subscriber and segment logic
 
# subscriber save and datatable
Route::get('/subscriber', 'SubscriberController@index');
Route::post('/subscriber/save', 'SubscriberController@store');

# subscriber datatable by segments
Route::get('/subscriber/list', 'SubscriberController@view');
Route::post('/subscriber/list', 'SubscriberController@show');

# segment save and datatable
Route::get('/segment', 'SegmentController@index');
Route::post('/segment/save', 'SegmentController@store');
