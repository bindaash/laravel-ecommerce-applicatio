<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index() //Request $request
    {
        $orders = $this->orderRepository->listOrders();
        $this->setPageTitle('Orders', 'List of all orders');
        //$data = $request->session()->all();
        //dd($data);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        $this->setPageTitle('Order Details', $orderNumber);
        return view('admin.orders.show', compact('order'));
    }

    public function delete($id){
        
        $orders = $this->orderRepository->deleteOrderById($id);

        return redirect()->back()->with('success', 'Order deleted successfully!');
        //dd($orders); return back()->with('success','Item created successfully!');

    }
    
}
