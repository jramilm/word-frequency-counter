<?php
    function totalPrice(array $item_prices) : float {
        /**
         * Calculate the total price of items in a shopping cart
         *
         * @param array $item_price is the list of prices in the cart
         */

        $total = 0;
        foreach ($item_prices as $item) {
            $total += $item;
        }

        return $total;
    }

    function compressAndShrink(string $string) : string {

        /**
         *Remove spaces and convert to lowercase
         *
         *@param string $string is the word or sentence to be manipulated
         */

        return strtolower(str_replace(' ', '', $string));
    }

    function isEven(int $num) : bool {
        /**
         *Check if a number is even or odd
         *
         *@param int $num is the number to be evaluated
         */

        if ($num % 2 == 0) {
            return true;
        } else {
            return false;
        }
    }
