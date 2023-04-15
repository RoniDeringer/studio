<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="clientes"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="mb-0">Clientes</h5>
                                <p class="text-sm mb-0">
                                    Clique no cliente para ver os atendimentos
                                </p>
                            </div>
                            <div class="table-responsive">
                                <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
                                    <div class="dataTable-top">
                                        <div class="dataTable-dropdown"><label><select class="dataTable-selector">
                                                    <option value="5">5</option>
                                                    <option value="10" selected="">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                </select> Registros por página</label></div>
                                    </div>
                                    <div class="dataTable-container" style="height: 500.641px;">
                                        <table class="table table-flush dataTable-table" id="datatable-basic">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 19.5831%;"><a href="#"
                                                            class="dataTable-sorter">Name</a></th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 27.2268%;"><a href="#"
                                                            class="dataTable-sorter">Position</a></th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 16.7404%;"><a href="#"
                                                            class="dataTable-sorter">Office</a></th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 8.3386%;"><a href="#"
                                                            class="dataTable-sorter">Age</a></th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 15.0979%;"><a href="#"
                                                            class="dataTable-sorter">Start date</a></th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        data-sortable="" style="width: 13.0133%;"><a href="#"
                                                            class="dataTable-sorter">Salary</a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Tiger Nixon</td>
                                                    <td class="text-sm font-weight-normal">System Architect</td>
                                                    <td class="text-sm font-weight-normal">Edinburgh</td>
                                                    <td class="text-sm font-weight-normal">61</td>
                                                    <td class="text-sm font-weight-normal">2011/04/25</td>
                                                    <td class="text-sm font-weight-normal">$320,800</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Garrett Winters</td>
                                                    <td class="text-sm font-weight-normal">Accountant</td>
                                                    <td class="text-sm font-weight-normal">Tokyo</td>
                                                    <td class="text-sm font-weight-normal">63</td>
                                                    <td class="text-sm font-weight-normal">2011/07/25</td>
                                                    <td class="text-sm font-weight-normal">$170,750</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Ashton Cox</td>
                                                    <td class="text-sm font-weight-normal">Junior Technical Author</td>
                                                    <td class="text-sm font-weight-normal">San Francisco</td>
                                                    <td class="text-sm font-weight-normal">66</td>
                                                    <td class="text-sm font-weight-normal">2009/01/12</td>
                                                    <td class="text-sm font-weight-normal">$86,000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Cedric Kelly</td>
                                                    <td class="text-sm font-weight-normal">Senior Javascript Developer</td>
                                                    <td class="text-sm font-weight-normal">Edinburgh</td>
                                                    <td class="text-sm font-weight-normal">22</td>
                                                    <td class="text-sm font-weight-normal">2012/03/29</td>
                                                    <td class="text-sm font-weight-normal">$433,060</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Airi Satou</td>
                                                    <td class="text-sm font-weight-normal">Accountant</td>
                                                    <td class="text-sm font-weight-normal">Tokyo</td>
                                                    <td class="text-sm font-weight-normal">33</td>
                                                    <td class="text-sm font-weight-normal">2008/11/28</td>
                                                    <td class="text-sm font-weight-normal">$162,700</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Brielle Williamson</td>
                                                    <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                    <td class="text-sm font-weight-normal">New York</td>
                                                    <td class="text-sm font-weight-normal">61</td>
                                                    <td class="text-sm font-weight-normal">2012/12/02</td>
                                                    <td class="text-sm font-weight-normal">$372,000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Herrod Chandler</td>
                                                    <td class="text-sm font-weight-normal">Sales Assistant</td>
                                                    <td class="text-sm font-weight-normal">San Francisco</td>
                                                    <td class="text-sm font-weight-normal">59</td>
                                                    <td class="text-sm font-weight-normal">2012/08/06</td>
                                                    <td class="text-sm font-weight-normal">$137,500</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Rhona Davidson</td>
                                                    <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                    <td class="text-sm font-weight-normal">Tokyo</td>
                                                    <td class="text-sm font-weight-normal">55</td>
                                                    <td class="text-sm font-weight-normal">2010/10/14</td>
                                                    <td class="text-sm font-weight-normal">$327,900</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Colleen Hurst</td>
                                                    <td class="text-sm font-weight-normal">Javascript Developer</td>
                                                    <td class="text-sm font-weight-normal">San Francisco</td>
                                                    <td class="text-sm font-weight-normal">39</td>
                                                    <td class="text-sm font-weight-normal">2009/09/15</td>
                                                    <td class="text-sm font-weight-normal">$205,500</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm font-weight-normal">Sonya Frost</td>
                                                    <td class="text-sm font-weight-normal">Software Engineer</td>
                                                    <td class="text-sm font-weight-normal">Edinburgh</td>
                                                    <td class="text-sm font-weight-normal">23</td>
                                                    <td class="text-sm font-weight-normal">2008/12/13</td>
                                                    <td class="text-sm font-weight-normal">$103,600</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="dataTable-bottom">
                                        <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                                        <nav class="dataTable-pagination">
                                            <ul class="dataTable-pagination-list">
                                                <li class="pager"><a href="#" data-page="1">‹</a></li>
                                                <li class="active"><a href="#" data-page="1">1</a></li>
                                                <li class=""><a href="#" data-page="2">2</a></li>
                                                <li class=""><a href="#" data-page="3">3</a></li>
                                                <li class=""><a href="#" data-page="4">4</a></li>
                                                <li class=""><a href="#" data-page="5">5</a></li>
                                                <li class=""><a href="#" data-page="6">6</a></li>
                                                <li class="pager"><a href="#" data-page="2">›</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
