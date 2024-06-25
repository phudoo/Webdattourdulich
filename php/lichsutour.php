<?php
                        $sql = "SELECT * FROM dattour WHERE tentaikhoan = '" . $_SESSION['tentaikhoan'] . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . " - <strong>Ngày Bắt Đầu:</strong> " . $row["ngaybatdau"] . "</p>";
                            }
                        } else {
                            echo "<p>Không có lịch sử đặt tour</p>";
                        }
                        ?>