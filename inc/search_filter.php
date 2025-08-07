<div class="search_filter_wrapper">
    <div class="search_filter">
        <h4>Danh mục</h4>
        <ul class="category_filter">
            <?php
            $categories = $cat->show_category_fontend();
            $priorityOrder = ['iPhone', 'iPad', 'MacBook'];
            $orderedCategories = [];
            $otherCategories = [];

            if ($categories) {
                while ($category = $categories->fetch_assoc()) {
                    if (in_array($category['catName'], $priorityOrder)) {
                        $orderedCategories[array_search($category['catName'], $priorityOrder)] = $category;
                    } else {
                        $otherCategories[] = $category;
                    }
                }
                ksort($orderedCategories);
                foreach ($orderedCategories as $category) {
                    displayCategory($category);
                }
                foreach ($otherCategories as $category) {
                    displayCategory($category);
                }
            }
            function displayCategory($category)
            {
                echo '<li class="category-item">';
                if (in_array($category['catName'], ['iPhone', 'iPad', 'MacBook'])) {
                    echo '<a href="productbycat.php?catId=' . $category['catId'] . '">' . $category['catName'] . '<span class="icon-arrow"> ⇣</span></a>';
                } else {
                    echo '<a href="productbycat.php?catId=' . $category['catId'] . '">' . $category['catName'] . '</a>';
                }
                if (in_array($category['catName'], ['iPhone', 'iPad', 'MacBook'])) {
                    echo '<ul class="subcategory">';
                    if ($category['catName'] == 'iPhone') {
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPhone%2013">Series 13</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPhone%2014">Series 14</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPhone%2015">Series 15</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPhone%2016">Series 16</a></li>';

                        echo '<ul class="memory">';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=128GB">128GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=256GB">256GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=512GB">512GB</a></li>';
                        echo '</ul>';
                    }
                    if ($category['catName'] == 'iPad') {
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPad%20Pro">iPad Pro</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPad%20Air">iPad Air</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=iPad%20Mini">iPad Mini</a></li>';

                        echo '<ul class="memory">';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=64GB">64GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=128GB">128GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=256GB">256GB</a></li>';
                        echo '</ul>';
                    }
                    if ($category['catName'] == 'MacBook') {
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=MacBook%20Air">MacBook Air</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&series=MacBook%20Pro">MacBook Pro</a></li>';

                        echo '<ul class="memory">';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=128GB">128GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=256GB">256GB</a></li>';
                        echo '<li><a href="productbycat.php?catId=' . $category['catId'] . '&memory=512GB">512GB</a></li>';
                        echo '</ul>';
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</div>
