# Strategy

## Một thiết kế cho Open/Close Principles

### Định Nghĩa

- Strategy là một behavior design.
- Các behavior trong một object có thể hoán đổi lẫn nhau một cách dễ dàng bên trong orginal context object.

### Class diagram

![uml](./uml.png?raw=true "uml_class")


### Pseudocode

```
// The strategy interface declares operations common to all
// supported versions of some algorithm. The context uses this
// interface to call the algorithm defined by the concrete
// strategies.
interface Strategy is
    method execute(a, b)

// Concrete strategies implement the algorithm while following
// the base strategy interface. The interface makes them
// interchangeable in the context.
class ConcreteStrategyAdd implements Strategy is
    method execute(a, b) is
        return a + b

class ConcreteStrategySubtract implements Strategy is
    method execute(a, b) is
        return a - b

class ConcreteStrategyMultiply implements Strategy is
    method execute(a, b) is
        return a * b

// The context defines the interface of interest to clients.
class Context is
    // The context maintains a reference to one of the strategy
    // objects. The context doesn't know the concrete class of a
    // strategy. It should work with all strategies via the
    // strategy interface.
    private strategy: Strategy

    // Usually the context accepts a strategy through the
    // constructor, and also provides a setter so that the
    // strategy can be switched at runtime.
    method setStrategy(Strategy strategy) is
        this.strategy = strategy

    // The context delegates some work to the strategy object
    // instead of implementing multiple versions of the
    // algorithm on its own.
    method executeStrategy(int a, int b) is
        return strategy.execute(a, b)


// The client code picks a concrete strategy and passes it to
// the context. The client should be aware of the differences
// between strategies in order to make the right choice.
class ExampleApplication is
    method main() is
        Create context object.

        Read first number.
        Read last number.
        Read the desired action from user input.

        if (action == addition) then
            context.setStrategy(new ConcreteStrategyAdd())

        if (action == subtraction) then
            context.setStrategy(new ConcreteStrategySubtract())

        if (action == multiplication) then
            context.setStrategy(new ConcreteStrategyMultiply())

        result = context.executeStrategy(First number, Second number)

        Print result.
```

### Applicability

- Sử dụng khi cần có nhiều thuật toán biến thể khác nhau trong một object:
    + Mẫu Chiến lược cho phép bạn gián tiếp thay đổi hành vi của đối tượng trong thời gian chạy bằng cách liên kết nó với các đối tượng phụ khác nhau có thể thực hiện các nhiệm vụ phụ cụ thể theo những cách khác nhau.

- Sử dụng Chiến lược khi bạn có nhiều lớp giống nhau chỉ khác nhau về cách chúng thực hiện một số hành vi.

    + Mẫu Chiến lược cho phép bạn trích xuất các hành vi khác nhau thành một hệ thống phân cấp lớp riêng biệt và kết hợp các lớp ban đầu thành một, do đó giảm mã trùng lặp.

- Sử dụng Chiến lược khi bạn có nhiều lớp giống nhau chỉ khác nhau về cách chúng thực hiện một số hành vi.

### Pros and Cons

- Pros: 
    + Chuyển đổi dễ dàng giữa các thuật toán.
    + Tách được phần thuật toán xử lý ra khỏi context object dễ bảo trì và thay đổi nó hơn
    + Thay thế kế thừa bằng component
    + Tuân thủ O trong SOLID ( Open/Closed Principle ).

- Cons:
    + Nếu có vài thuật toán mà chúng không thay đổi thì đừng cố tạo các interface sẽ khiến code thêm phần rắc rối nhưng phải lựa chọn và đánh đổi đôi khi bất kì sự lựa chọn nào cũng có mặt đúng sai.
    + Vì khách hàng là người quyết định logic kinh doanh nên họ phải nhận thức được sự khác biệt
    